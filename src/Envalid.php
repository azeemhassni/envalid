<?php

namespace azi;


use azi\Contracts\ErrorBagInterface;
use azi\Rules\AlNum;
use azi\Rules\Alpha;
use azi\Rules\ArrayRule;
use azi\Rules\Boolean;
use azi\Rules\Contracts\RuleInterface;
use azi\Rules\Email;
use azi\Rules\File;
use azi\Rules\IP;
use azi\Rules\Length;
use azi\Rules\Max;
use azi\Rules\Min;
use azi\Rules\Number;
use azi\Rules\Password;
use azi\Rules\Required;
use azi\Rules\Same;

/**
 * Class Envalid
 *
 * @package azi
 */
class Envalid
{
    protected $userRules;

    /**
     * @var RuleInterface[]
     */
    protected $rules = [];
    protected $data;

    /**
     * @var ErrorBagInterface
     */
    protected $errorBag;

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->loadDefaultRules();
        $this->errorBag = new ErrorBag();
    }

    /**
     * Sets default rules
     *
     * @return void
     */
    protected function loadDefaultRules()
    {
        $this->rules[ 'email' ]    = new Email();
        $this->rules[ 'required' ] = new Required();
        $this->rules[ 'file' ]     = new File();
        $this->rules[ 'bool' ]     = $this->rules[ 'boolean' ] = new Boolean();
        $this->rules[ 'bool' ]     = new Boolean();
        $this->rules[ 'array' ]    = new ArrayRule();
        $this->rules[ 'password' ] = new Password();
        $this->rules[ 'num' ]      = $this->rules[ 'number' ] = new Number();
        $this->rules[ 'len' ]      = $this->rules[ 'length' ] = new Length();
        $this->rules[ 'min' ]      = $this->rules[ 'minimum' ] = new Min();
        $this->rules[ 'max' ]      = $this->rules[ 'maximum' ] = new Max();
        $this->rules[ 'alpha' ]    = new Alpha();
        $this->rules[ 'alnum' ]    = $this->rules[ 'string' ] = new AlNum();
        $this->rules[ 'ip' ]       = new IP();
        $this->rules[ 'same' ]     = new Same();
    }

    /**
     * @param $data
     * @param $rules
     * @return $this
     */
    public function validate($data, $rules)
    {
        $this->userRules = $rules;
        $this->data      = $data;

        // We'll go through each field
        // and fetch the rules from passed rules
        // and explode the rules by | and parse the rule
        // init the rule and pass the args to validate method
        foreach ($data as $field => $value) {

            if (!isset($rules[ $field ])) {
                continue;
            }

            $userRules = explode('|', $rules[ $field ]);

            foreach ($userRules as $rule) {
                $parsed      = $this->parseRule($rule);
                $ruleName    = $parsed[ 'rule' ];
                $ruleMessage = $parsed[ 'message' ];

                if (!isset($this->rules[ $ruleName ])) {
                    trigger_error(sprintf("Rule `%s` is not recognized, please register it using \azi\Envalid::addRule(\$ruleName, \$ruleClass) method",
                        $ruleName));
                }

                $ruleClass = @$this->rules[ $ruleName ];
                if (is_callable($ruleClass)) {
                    $ruleMessage = call_user_func_array($ruleClass, [
                        $field,
                        $value,
                        $parsed[ 'args' ]
                    ]);

                    $valid = $ruleMessage === true;
                } else {
                    $valid = $ruleClass->validate($field, $value, $parsed[ 'args' ]);
                }

                if (!$ruleMessage) {
                    $ruleMessage = str_replace(['{field}'], $this->labelize($field), $ruleClass->message());
                }

                if (!$valid) {
                    $this->getErrors()->addError($field, $ruleMessage);
                }
            }

        }

    }

    /**
     * Parse the rule for arguments
     *
     * @param $rule
     * @return array
     */
    protected function parseRule($rule)
    {
        // arguments can be passed in rule--key=value=key2=value2 syntax
        $args      = [];
        $variables = [];
        $message   = false;


        if (strpos($rule, '--')) {
            // we've arguments
            $parsed = explode('--', $rule);
            $rule   = $parsed[ 0 ];

            parse_str($parsed[ 1 ], $args);

            if (isset($args[ 'message' ])) {
                $message = $args[ 'message' ];
            }

        }


        if (strpos($rule, ':')) {
            $parsed = explode(':', $rule);
            $rule   = $parsed[ 0 ];
            unset($parsed[ 0 ]); // remove rule name
            $variables = ['variables' => array_values($parsed)];
        }

        $args = new Arguments(array_merge($args, $variables));
        $args->set('validator', $this);

        return [
            'rule'    => $rule,
            'message' => $message,
            'args'    => $args
        ];
    }

    /**
     * @param $field
     * @return string
     */
    public function labelize($field)
    {
        return ucwords(str_replace(['-', '_'], ' ', $field));
    }

    /**
     * @return ErrorBagInterface
     */
    public function getErrors()
    {
        return $this->errorBag;
    }

    /**
     * Returns fields available for validation
     *
     * @return array
     */
    public function getFields()
    {
        return $this->data;
    }

    /**
     * Register a new Rule to validator
     *
     * @param $id
     * @param callable|RuleInterface $rule
     * @return $this
     * @throws \Exception
     */
    public function addRule($id, $rule)
    {
        if (!is_callable($rule) && !$rule instanceof RuleInterface) {
            throw new \Exception("Rule must be callable or an instance of " . '\azi\Rules\Contracts\RuleInterface');
        }

        $this->rules[ $id ] = $rule;
        return $this;
    }

    /**
     * Get the Rules for current validation strategy
     *
     * @return array
     */
    public function getRules()
    {
        return $this->userRules;
    }

    /**
     * @param mixed $errorBag
     * @return Envalid
     */
    public function setErrorBag(ErrorBagInterface $errorBag)
    {
        $this->errorBag = $errorBag;
        return $this;
    }

    /**
     * @return bool
     */
    public function failed()
    {
        return !$this->passed();
    }

    /**
     * @return bool
     */
    public function passed()
    {
        return $this->errorBag->isEmpty();
    }
}

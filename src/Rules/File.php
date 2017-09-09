<?php

namespace azi\Rules;


use azi\Arguments;
use azi\Rules\Contracts\RuleInterface;

/**
 * Class File
 *
 * @package azi\Rules
 */
class File implements RuleInterface
{
    protected $types = [
        'image' => [
            'image/jpeg',
            'image/jpg',
            'image/gif',
            'image/png',
        ],
        'video' => [
            'video/mp4',
            'video/3gpp',
            'video/x-msvideo',
            'video/x-msvideo',
            'ideo/x-flv',
            'video/ogg',
        ],
        'doc'   => [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.oasis.opendocument.text'
        ]
    ];

    protected $message;

    /**
     * @param $field
     * @param $file
     * @param Arguments $args
     * @return mixed
     */
    public function validate($field, $file, Arguments $args)
    {
        $allowed_types = $args->getVariables();
        $type          = mime_content_type($file[ 'tmp_name' ]);

        if (empty($type)) {
            $this->message = "";
            return false;
        }

        $allowed_types = is_array($allowed_types) ? $allowed_types : [$allowed_types];

        foreach ($allowed_types as $allowed_type) {

            if (!isset($this->types[ $allowed_type ])) {
                continue;
            }

            if (in_array($type, $this->types[ $allowed_type ])) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function message()
    {
        if ($this->message) {
            return $this->message;
        }

        return "File must be in required format";
    }
}
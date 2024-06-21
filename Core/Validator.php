<?php

namespace Core;

class Validator
{
    /**
     * @var array $patterns
     */
    public $patterns = [
        'uri'           => '[A-Za-z0-9-\/_?&=]+',
        'url'           => '[A-Za-z0-9-:.\/_?&=#]+',
        'alpha'         => '[\p{L}]+',
        'words'         => '[\p{L}\s]+',
        'alphanum'      => '[\p{L}0-9]+',
        'int'           => '[0-9]+',
        'float'         => '[0-9\.,]+',
        'tel'           => '[0-9+\s()-]+',
        'text'          => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
        'file'          => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
        'folder'        => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
        'address'       => '[\p{L}0-9\s.,()°-]+',
        'date_dmy'      => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
        'date_ymd'      => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
        'email'         => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]'
    ];

    public $errors = [];

    public string $name;
    public mixed $value;
    public $file;

    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function file($value)
    {
        $this->file = $value;
        return $this;
    }

    public function pattern($name)
    {
        if ($name == 'array') {
            if (!is_array($this->value)) {
                $this->errors[$this->name] = $this->name . ' is not valid';
            }
        } else {
            $regex = '/^(' . $this->patterns[$name] . ')$/u';
            if ($this->value !== '' && !preg_match($regex, $this->value)) {
                $this->errors[$this->name] = $this->name . ' is not valid';
            }
        }
        return $this;
    }

    public function required(): self
    {
        if ((isset($this->file) && $this->file['error'] == 4) || ($this->value === '' || $this->value === null)) {
            $this->errors[$this->name] = $this->name . ' field is required.';
        }
        return $this;
    }
    public function min($length): self
    {
        $value =  is_string($this->value) ? strlen($this->value) : $this->value;
        if ($value < $length) {
            $this->errors[$this->name] = 'The ' . $this->name . ' filed is lower then the minimum of ' . $length;
        }
        return $this;
    }

    public function max($length): self
    {
        $value =  is_string($this->value) ? strlen($this->value) : $this->value;
        if ($value > $length) {
            $this->errors[$this->name] = 'The ' . $this->name . ' filed is bigger then the max of ' . $length;
        }
        return $this;
    }

    public function equal($value)
    {
        if ($this->value != $value) {
            $this->errors[$this->name] = $this->name . ' not equal to ' . $value;
        }
        return $this;
    }

    public function email()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$this->name] = 'Invalid email';
        }
        return $this;
    }

    public function passes(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

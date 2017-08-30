<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Libraries\Utils;

use Illuminate\Support\Facades\Validator;

class CustomValidations
{

    private static $instance;


    public static function instance()
    {
        if ( !isset(self::$instance) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Define Validation Rules
     *
     * @return void
     */
    public function defineRules()
    {
        Validator::extend("foo", "\Ponut\Libraries\Utils\CustomValidations@fooRule");
        Validator::extend("bar", "\Ponut\Libraries\Utils\CustomValidations@barRule");
        Validator::extend("plain", "\Ponut\Libraries\Utils\CustomValidations@plainRule");
        Validator::extend("username", "\Ponut\Libraries\Utils\CustomValidations@usernameRule");
        Validator::extend("password", "\Ponut\Libraries\Utils\CustomValidations@passwordRule");
        Validator::extend("username_or_email", "\Ponut\Libraries\Utils\CustomValidations@usernameoremailRule");
    }

    /**
     * Foo Rule
     *
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @param mixed $validator
     * @return boolean
     */
    public function fooRule($attribute, $value, $parameters, $validator)
    {
        return $value == 'foo';
    }

    /**
     * Bar Rule
     *
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @param mixed $validator
     * @return boolean
     */
    public function barRule($attribute, $value, $parameters, $validator)
    {
        return $value == 'bar';
    }

    /**
     * Check if text is plain
     *
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @param mixed $validator
     * @return boolean
     */
    public function plainRule($attribute, $value, $parameters, $validator)
    {
        $value = filter_var(trim($value), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        return (boolean) !empty($value);
    }

    /**
     * Validate if username is valid and meet minimum requirements
     *
     * For username to pass it must have lenght of 5 or more
     * and contain words and numbers are optional
     *
     * Username Must be alphanumeric containing at least 3 letters
     *
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @param mixed $validator
     * @return boolean
     */
    public function usernameRule($attribute, $value, $parameters, $validator)
    {
        return (boolean) (preg_match('/^(?=\w*[a-z]{3})(\w+)$/i', $value));
    }

    /**
     * Validate if input is a valid username or email
     *
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @param mixed $validator
     * @return boolean
     */
    public function usernameoremailRule($attribute, $value, $parameters, $validator)
    {
        if( strpos($value, '@') ){
            return (boolean) filter_var($value, FILTER_VALIDATE_EMAIL);
        }else{
            return (boolean) (preg_match('/^(?=\w*[a-z]{3})(\w+)$/i', $value));
        }
    }

    /**
     * Validate if password is valid and meet minimum requirements To be strong
     *
     * For password to pass it must have lenght of 8 or more
     * and contain at least two numbers and the rest may be numbers, letters or special char (!@#$%^&*(){}[]|?:;,.+-_)
     *
     * @param mixed $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @param mixed $validator
     * @return boolean
     */
    public function passwordRule($attribute, $value, $parameters, $validator)
    {
        $value = trim($value);
        $pwd_length = strlen($value);
        preg_match_all('/[0-9]/', $value, $match);
        $digits_lenght = count($match[0]);
        preg_match_all('/[a-z]/i', $value, $match);
        $letters_lenght = count($match[0]);
        preg_match_all('/[!@#$%^&*(){}\[\]|?:;,.+\-_]/', $value, $match);
        $special_chars_lenght = count($match[0]);
        return (boolean) ( ($digits_lenght >= 2) && ($pwd_length >= 8) && ($pwd_length == ($digits_lenght + $letters_lenght + $special_chars_lenght)) );
    }
}

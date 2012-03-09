<?php
/**
 * File containing the TextBlock class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\Core\Repository\FieldType\TextBlock;
use eZ\Publish\Core\Repository\FieldType\TextLine\Type as TextLine,
    ezp\Base\Exception\InvalidArgumentValue,
    ezp\Base\Exception\InvalidArgumentType;

/**
 * The TextBlock field type.
 *
 * Represents a larger body of text, such as text areas.
 */
class Type extends TextLine
{
    protected $allowedValidators = array();

    protected $allowedSettings = array( 'textColumns' => 10 );

    /**
     * Build a Value object of current FieldType
     *
     * Build a FiledType\Value object with the provided $text as value.
     *
     * @param string $text
     * @return \eZ\Publish\Core\Repository\FieldType\TextBlock\Value
     * @throws \eZ\Publish\API\Repository\Exceptions\InvalidArgumentException
     */
    public function buildValue( $text )
    {
        return new Value( $text );
    }

    /**
     * Return the field type identifier for this field type
     *
     * @return string
     */
    public function getFieldTypeIdentifier()
    {
        return "eztext";
    }

    /**
     * Returns the fallback default value of field type when no such default
     * value is provided in the field definition in content types.
     *
     * @return \eZ\Publish\Core\Repository\FieldType\TextBlock\Value
     */
    public function getDefaultDefaultValue()
    {
        return new Value( "" );
    }

    /**
     * Checks the type and structure of the $Value.
     *
     * @throws \ezp\Base\Exception\InvalidArgumentType if the parameter is not of the supported value sub type
     * @throws \ezp\Base\Exception\InvalidArgumentValue if the value does not match the expected structure
     *
     * @param \eZ\Publish\Core\Repository\FieldType\TextBlock\Value $inputValue
     *
     * @return \eZ\Publish\Core\Repository\FieldType\TextBlock\Value
     */
    public function acceptValue( $inputValue )
    {
        if ( !$inputValue instanceof Value )
        {
            throw new InvalidArgumentType( 'value', 'eZ\\Publish\\Core\\Repository\\FieldType\\TextBlock\\Value' );
        }

        if ( !is_string( $inputValue->text ) )
        {
            throw new InvalidArgumentValue( $inputValue, get_class( $this ) );
        }

        return $inputValue;
    }

    /**
     * Returns information for FieldValue->$sortKey relevant to the field type.
     *
     * @return array
     */
    protected function getSortInfo( $value )
    {
        return array( 'sort_key_string' => '' );
    }

    /**
     * Converts an $hash to the Value defined by the field type
     *
     * @param mixed $hash
     *
     * @return \eZ\Publish\Core\Repository\FieldType\TextBlock\Value $value
     */
    public function fromHash( $hash )
    {
        return new Value( $hash );
    }

    /**
     * Converts a $Value to a hash
     *
     * @param \eZ\Publish\Core\Repository\FieldType\TextBlock\Value $value
     *
     * @return mixed
     */
    public function toHash( $value )
    {
        return $value->text;
    }

    /**
     * Returns whether the field type is searchable
     *
     * @return bool
     */
    public function isSearchable()
    {
        return true;
    }
}
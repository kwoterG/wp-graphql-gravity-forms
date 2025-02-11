<?php

namespace WPGraphQLGravityForms\Types\Field;

use WPGraphQLGravityForms\Types\Field\FieldProperty;
use WPGraphQLGravityForms\Types\Field\FieldValue\StringFieldValue;

/**
 * Single-line text field.
 *
 * @see https://docs.gravityforms.com/gf_field_text/
 */
class TextField extends Field {
    /**
     * Type registered in WPGraphQL.
     */
    const TYPE = 'TextField';

    /**
     * Type registered in Gravity Forms.
     */
    const GF_TYPE = 'text';

    /**
     * Field value type.
     */
    const VALUE_TYPE = StringFieldValue::TYPE;

    public function register_hooks() {
        add_action( 'graphql_register_types', [ $this, 'register_type' ] );
    }

    public function register_type() {
        register_graphql_object_type( self::TYPE, [
            'description' => __( 'Gravity Forms Single Line Text field.', 'wp-graphql-gravity-forms' ),
            'fields'      => array_merge(
                $this->get_global_properties(),
                FieldProperty\DefaultValueProperty::get(),
                FieldProperty\ErrorMessageProperty::get(),
                FieldProperty\InputNameProperty::get(),
                FieldProperty\IsRequiredProperty::get(),
                FieldProperty\NoDuplicatesProperty::get(),
                FieldProperty\SizeProperty::get(),
                FieldProperty\MaxLengthProperty::get(),
                [
                    'enablePasswordInput' => [
                        'type'        => 'Boolean',
                        'description' => __('Determines if a text field input tag should be created with a "password" type.', 'wp-graphql-gravity-forms'),
                    ],
                ]
            ),
        ] );
    }
}

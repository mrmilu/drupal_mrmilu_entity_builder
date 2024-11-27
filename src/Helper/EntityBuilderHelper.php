<?php

namespace Drupal\mrmilu_entity_builder\Helper;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * Helper class to create fields in custom entities.
 */
class EntityBuilderHelper {

  public static function createFieldTextfield($label, $required, $translatable) {
    return BaseFieldDefinition::create('string')
      ->setLabel($label)
      ->setRequired($required)
      ->setTranslatable($translatable)
      ->setSettings([
        'max_length' => 254,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldTextarea($label, $description, $required, $translatable) {
    return BaseFieldDefinition::create('string_long')
      ->setLabel($label)
      ->setDescription($description)
      ->setRequired($required)
      ->setTranslatable($translatable)
      ->setSettings([
        'max_length' => 254,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string_long',
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_long',
        'text_processing' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldFormattedTextarea($label, $description, $required, $translatable) {
    return BaseFieldDefinition::create('text_long')
      ->setLabel($label)
      ->setDescription($description)
      ->setRequired($required)
      ->setTranslatable($translatable)
      ->setSettings([
        'max_length' => 254,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'text_default',
      ])
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'text_processing' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldInteger($label, $required) {
    return BaseFieldDefinition::create('integer')
      ->setLabel($label)
      ->setRequired($required)
      ->setDefaultValue(0)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'settings' => [
          'display_label' => TRUE,
        ],
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldList($label, $required, $options, $multiple = FALSE) {
    $field = BaseFieldDefinition::create('list_string')
      ->setLabel($label)
      ->setRequired($required)
      ->setSettings([
        'allowed_values' => $options])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
      ])
      ->setDisplayOptions('form', [
        'type' => $multiple ? 'options_buttons' : 'string_textfield',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    if ($multiple) $field->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED);
    return $field;
  }

  /**
   * Create field image.
   *
   * @param string $label
   *   The label for image field.
   * @param bool $required
   *   Check if field is required or not.
   * @param bool $focalPoint
   *   Check if form add support for focal point.
   * @param bool $webpSupport
   *   Check if webp extension is allowed.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldImage(string $label, bool $required, bool $focalPoint = FALSE, bool $webpSupport = FALSE): BaseFieldDefinition {
    return BaseFieldDefinition::create('image')
      ->setLabel($label)
      ->setRequired($required)
      ->setSettings([
        'alt_field' => FALSE,
        'alt_field_required' => FALSE,
        'title_field' => FALSE,
        'title_field_required' => FALSE,
        'file_extensions' => $webpSupport ? 'png jpg jpeg webp' : 'png jpg jpeg',
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'default',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'label' => 'hidden',
        'type' => $focalPoint ? 'image_focal_point' : 'image_image',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldEmail($label, $required) {
    return BaseFieldDefinition::create('email')
      ->setLabel($label)
      ->setRequired($required)
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'string',
      ])
      ->setDisplayOptions('form', [
        'type' => 'email_default',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldBoolean($label) {
    return BaseFieldDefinition::create('boolean')
      ->setLabel($label)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'checked' => 'checked'
      ])
      ->setDisplayConfigurable('form', TRUE);
  }

  public static function createFieldEntityReference($label, $targetType, $required = FALSE) {
    return BaseFieldDefinition::create('entity_reference')
      ->setLabel($label)
      ->setRequired($required)
      ->setSetting('target_type', $targetType)
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'entity_reference_label',
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

  }

  public static function createFieldParagraph($label, $bundles, $required, $translatable) {
    return BaseFieldDefinition::create('entity_reference_revisions')
      ->setLabel($label)
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setRequired($required)
      ->setTranslatable($translatable)
      ->setSetting('target_type', 'paragraph')
      ->setSetting('handler', 'default:paragraph')
      ->setSetting('handler_settings', ['target_bundles' => $bundles])
      ->setSetting('handler_settings', ['negate' => 0])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_paragraphs',
        'settings' => [
          'title' => 'Paragraph',
          'title_plural' => 'Paragraphs',
          'edit_mode' => 'open',
          'add_mode' => 'dropdown',
          'form_display_mode' => 'default',
          'default_paragraph_type' => '',
        ],
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);
  }

  public static function createFieldNodeReference($label, $targetType, $bundle, $required = FALSE) {
    return BaseFieldDefinition::create('entity_reference')
      ->setLabel($label)
      ->setRequired($required)
      ->setSetting('target_type', $targetType)
      ->setSetting('handler', 'default')
      ->setSetting('handler_settings',
        ['target_bundles' => [$bundle => $bundle]]
      )
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'entity_reference_label',
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldDatetime($label, $required) {
    return BaseFieldDefinition::create('datetime')
      ->setLabel($label)
      ->setRequired($required)
      ->setSettings([
        'datetime_type' => 'date'
      ])
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'datetime_default',
        'settings' => [
          'format_type' => 'medium',
        ],
      ))
      ->setDisplayOptions('form', array(
        'type' => 'datetime_default',
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  public static function createFieldLink($label, $required, $translatable, $linkType, $titleEnabled) {
    return BaseFieldDefinition::create('link')
      ->setLabel($label)
      ->setRequired($required)
      ->setTranslatable($translatable)
      ->setSettings([
        'link_type' => $linkType,
        'title' => $titleEnabled
      ])
      ->setDisplayOptions('form', [
        'type' => 'link_default',
      ])
      ->setDisplayConfigurable('form', TRUE);
  }
}

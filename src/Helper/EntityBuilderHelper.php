<?php

namespace Drupal\mrmilu_entity_builder\Helper;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * Helper class to create fields in custom entities.
 */
class EntityBuilderHelper {

  /**
   * Create field textfield.
   *
   * @param string $label
   *   The label for textfield field.
   * @param bool $required
   *   Check if field is required or not.
   * @param bool $translatable
   *   Check if field is translatable or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldTextfield(string $label, bool $required, bool $translatable): BaseFieldDefinition {
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

  /**
   * Create field textarea.
   *
   * @param string $label
   *   The label for textarea field.
   * @param string|null $description
   *   The description for textarea field.
   * @param bool $required
   *   Check if field is required or not.
   * @param bool $translatable
   *   Check if field is translatable or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldTextarea(string $label, ?string $description, bool $required, bool $translatable): BaseFieldDefinition {
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

  /**
   * Create field formatted textarea.
   *
   * @param string $label
   *   The label for formatted textarea field.
   * @param string|null $description
   *   The description for textarea field.
   * @param bool $required
   *   Check if field is required or not.
   * @param bool $translatable
   *   Check if field is translatable or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldFormattedTextarea(string $label, ?string $description, bool $required, bool $translatable): BaseFieldDefinition {
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

  /**
   * Create field integer.
   *
   * @param string $label
   *   The label for integer field.
   * @param bool $required
   *   Check if field is required or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldInteger(string $label, bool $required): BaseFieldDefinition {
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

  /**
   * Create field text list with options.
   *
   * @param string $label
   *   The label for list field.
   * @param bool $required
   *   Check if field is required or not.
   * @param array $options
   *   Field options.
   * @param bool $multiple
   *   Check if field is multiple or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldList(string $label, bool $required, array $options, bool $multiple = FALSE): BaseFieldDefinition {
    $field = BaseFieldDefinition::create('list_string')
      ->setLabel($label)
      ->setRequired($required)
      ->setSettings([
        'allowed_values' => $options,
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
      ])
      ->setDisplayOptions('form', [
        'type' => $multiple ? 'options_buttons' : 'string_textfield',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    if ($multiple) {
      $field->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED);
    }
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

  /**
   * Create field email.
   *
   * @param string $label
   *   The label for email field.
   * @param bool $required
   *   Check if field is required or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldEmail(string $label, bool $required): BaseFieldDefinition {
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

  /**
   * Create field boolean.
   *
   * @param string $label
   *   The label for boolean field.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldBoolean(string $label): BaseFieldDefinition {
    return BaseFieldDefinition::create('boolean')
      ->setLabel($label)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'checked' => 'checked',
      ])
      ->setDisplayConfigurable('form', TRUE);
  }

  /**
   * Create field entity reference.
   *
   * @param string $label
   *   The label for entity reference field.
   * @param string $targetType
   *   Referenced entity type.
   * @param bool $required
   *   Check if field is required or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldEntityReference(string $label, string $targetType, bool $required = FALSE): BaseFieldDefinition {
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

  /**
   * Create field paragraph.
   *
   * @param string $label
   *   The label for paragraph field.
   * @param array $bundles
   *   Possible bundles to be referenced in paragraph entity type.
   * @param bool $required
   *   Check if field is required or not.
   * @param bool $translatable
   *   Check if field is translatable or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldParagraph(string $label, array $bundles, bool $required, bool $translatable): BaseFieldDefinition {
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

  /**
   * Craete field node reference.
   *
   * @param string $label
   *   The label for node reference field.
   * @param string $targetType
   *   Referenced entity type.
   * @param string $bundle
   *   Possible bundle to be referenced in node entity type.
   * @param bool $required
   *   Check if field is required or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldNodeReference(string $label, string $targetType, string $bundle, bool $required = FALSE): BaseFieldDefinition {
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

  /**
   * Create field datetime.
   *
   * @param string $label
   *   The label for datetime field.
   * @param bool $required
   *   Check if field is required or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldDatetime(string $label, bool $required): BaseFieldDefinition {
    return BaseFieldDefinition::create('datetime')
      ->setLabel($label)
      ->setRequired($required)
      ->setSettings([
        'datetime_type' => 'date',
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'datetime_default',
        'settings' => [
          'format_type' => 'medium',
        ],
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

  /**
   * Create field link.
   *
   * @param string $label
   *   The label for link field.
   * @param bool $required
   *   Check if field is required or not.
   * @param bool $translatable
   *   Check if field is translatable or not.
   * @param int $linkType
   *   External, internal or both.
   * @param bool $titleEnabled
   *   Check if title is enabled or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldLink(string $label, bool $required, bool $translatable, int $linkType, bool $titleEnabled): BaseFieldDefinition {
    return BaseFieldDefinition::create('link')
      ->setLabel($label)
      ->setRequired($required)
      ->setTranslatable($translatable)
      ->setSettings([
        'link_type' => $linkType,
        'title' => $titleEnabled,
      ])
      ->setDisplayOptions('form', [
        'type' => 'link_default',
      ])
      ->setDisplayConfigurable('form', TRUE);
  }

  /**
   * Create field media image.
   *
   * @param string $label
   *   The label for image field.
   * @param bool $required
   *   Check if field is required or not.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   *   The entity field.
   */
  public static function createFieldMediaImage(string $label, bool $required): BaseFieldDefinition {
    return BaseFieldDefinition::create('entity_reference')
      ->setLabel($label)
      ->setRequired($required)
      ->setSetting('target_type', 'media')
      ->setSetting('handler', 'default')
      ->setSetting('handler_settings',
        ['target_bundles' => ['image' => 'image']]
      )
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'entity_reference_label',
      ])
      ->setDisplayOptions('form', [
        'type' => 'media_library_widget',
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
  }

}

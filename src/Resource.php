<?php

namespace Orchid\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Orchid\Screen\Field;
use Orchid\Screen\TD;

abstract class Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = '';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = '';

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title(): string
    {
        return $this->{static::$title};
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return Str::plural(static::nameWithoutResource());
    }

    /**
     * Get the displayable icon of the resource.
     *
     * @return string
     */
    public static function icon(): string
    {
        return 'folder';
    }

    /**
     * Get the displayable sort of the resource.
     *
     * @return string
     */
    public static function sort(): string
    {
        return 2000;
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    abstract public function columns(): array;

    /**
     * Get the fields displayed by the resource.
     *
     * @return Field[]
     */
    abstract public function fields(): array;

    /**
     * Get the URI key for the resource.
     *
     * @return string
     */
    public static function uriKey(): string
    {
        return Str::of(class_basename(static::class))->kebab()->plural();
    }

    /**
     * The underlying model resource instance.
     *
     * @return Model
     */
    public function getModel(): Model
    {
        return app(static::$model);
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel(): string
    {
        return __(Str::singular(Str::title(Str::snake(static::nameWithoutResource(), ' '))));
    }

    /**
     * @return string
     */
    public static function nameWithoutResource():string
    {
        return str_replace('Resource', '', class_basename(static::class));
    }

    /**
     * Get the text for the create resource button.
     *
     * @return string|null
     */
    public static function createButtonLabel(): string
    {
        return __('Create :resource', ['resource' => static::singularLabel()]);
    }

    /**
     * Get the text for the create resource toast.
     *
     * @return string
     */
    public static function createToastMessage(): string
    {
        return __('The :resource was created!', ['resource' => static::singularLabel()]);
    }

    /**
     * Get the text for the update resource button.
     *
     * @return string
     */
    public static function updateButtonLabel(): string
    {
        return __('Update :resource', ['resource' => static::singularLabel()]);
    }

    /**
     * Get the text for the update resource toast.
     *
     * @return string
     */
    public static function updateToastMessage(): string
    {
        return __('The :resource was updated!', ['resource' => static::singularLabel()]);
    }

    /**
     * Get the text for the delete resource button.
     *
     * @return string
     */
    public static function deleteButtonLabel(): string
    {
        return __('Delete :resource', ['resource' => static::singularLabel()]);
    }

    /**
     * Get the text for the delete resource toast.
     *
     * @return string
     */
    public static function deleteToastMessage(): string
    {
        return __('The :resource was deleted!', ['resource' => static::singularLabel()]);
    }

    /**
     * Get the text for the error resource toast.
     *
     * @return string
     */
    public static function errorToastMessage(): string
    {
        return __('An error has occurred. Action not taken.');
    }

    /**
     * Get the text for the save resource button.
     *
     * @return string
     */
    public static function saveButtonLabel(): string
    {
        return __('Save :resource', ['resource' => static::singularLabel()]);
    }

    /**
     * Get the validation rules that apply to save/update.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * Get relationships that should be eager loaded when performing an index query.
     *
     * @return array
     */
    public function with(): array
    {
        return [];
    }
}

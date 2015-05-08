<?php namespace RainLab\Location\Behaviors;

use Db;
use RainLab\Location\Models\State;
use RainLab\Location\Models\Country;
use System\Classes\ModelBehavior;
use ApplicationException;
use Exception;

/**
 * Location model extension
 *
 * Adds Country and State relations to a model
 *
 * Usage:
 *
 * In the model class definition:
 *
 *   public $implement = ['RainLab.Location.Behaviors.LocationModel'];
 *
 */
class LocationModel extends ModelBehavior
{

    /**
     * Constructor
     */
    public function __construct($model)
    {
        parent::__construct($model);

        $model->fillable(array_merge($model->getFillable(), ['country', 'state']));
        $model->belongsTo['country'] = ['RainLab\Location\Models\Country'];
        $model->belongsTo['state']   = ['RainLab\Location\Models\State'];

        // Fields
        // country:
        //     label: rainlab.user::lang.user.country
        //     type: dropdown
        //     tab: rainlab.user::lang.user.details
        //     span: left
        //     placeholder: rainlab.user::lang.user.select_country

        // state:
        //     label: rainlab.user::lang.user.state
        //     type: dropdown
        //     tab: rainlab.user::lang.user.details
        //     span: right
        //     dependsOn: country
        //     placeholder: rainlab.user::lang.user.select_state

        // Columns
        // country:
        //     label: rainlab.user::lang.user.country
        //     searchable: true
        //     invisible: true
        //     relation: country
        //     select: name
        //     sortable: false

        // state:
        //     label: rainlab.user::lang.user.state
        //     searchable: true
        //     invisible: true
        //     relation: country
        //     select: name
        //     sortable: false


        // !! Probably not needed, but who knows
        //


        // Default country/state
        // # Default Country
        // default_country:
        //     span: left
        //     label: rainlab.user::lang.settings.default_country
        //     comment: rainlab.user::lang.settings.default_country_comment
        //     type: dropdown
        //     tab: rainlab.user::lang.settings.location_tab

        // # Default State
        // default_state:
        //     span: right
        //     label: rainlab.user::lang.settings.default_state
        //     comment: rainlab.user::lang.settings.default_state_comment
        //     type: dropdown
        //     tab: rainlab.user::lang.settings.location_tab
        //     dependsOn: default_country


        // public function getDefaultCountryOptions()
        // {
        //     return Country::getNameList();
        // }

        // public function getDefaultStateOptions()
        // {
        //     return State::getNameList($this->default_country);
        // }
    }

    public function getCountryOptions()
    {
        return Country::getNameList();
    }

    public function getStateOptions()
    {
        return State::getNameList($this->model->country_id);
    }


}
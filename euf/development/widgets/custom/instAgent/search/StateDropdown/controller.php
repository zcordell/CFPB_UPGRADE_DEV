<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class StateDropdown extends Widget
{
    function __construct()
    {
        parent::__construct();

        $this->attrs['report_id'] = new Attribute(getMessage(REPORT_ID_LC_LBL), 'INT', getMessage(ID_RPT_DISP_DATA_SEARCH_RESULTS_MSG), CP_NOV09_ANSWERS_DEFAULT);
        $this->attrs['report_id']->min = 1;
        $this->attrs['report_id']->optlistId = OPTL_CURR_INTF_PUBLIC_REPORTS;
        $this->attrs['filter_name'] = new Attribute(getMessage(FILTER_NAME_LBL), 'STRING', getMessage(FILTER_DISP_DROPDOWN_INFORMATION_LBL), '');
        $this->attrs['label_any'] = new Attribute(getMessage(ANY_LBL), 'STRING', getMessage(TEXT_FOR_FIRST_DROP_DOWN_ITEM_LBL), getMessage(ANY_LBL));
        $this->attrs['search_on_select'] = new Attribute(getMessage(SEARCH_ON_SELECTED_CMD), 'BOOL', getMessage(START_SEARCH_SOON_ITEM_IS_SELECTED_MSG), false);
        $this->attrs['report_page_url'] = new Attribute(getMessage(REPORT_PAGE_LBL), 'STRING', getMessage(PG_DISP_ITEM_SEL_SRCH_SEL_SET_TRUE_MSG), '');
        $this->attrs['alt_menu_filter_name'] = new Attribute( "Alternate Menu Filter Name", "STRING", "The report filter will not be a menu, but rather a text field. We can pull the menu from another field, and this attribute will hold it.", '' );
    }

    function generateWidgetInformation()
    {
        $this->info['notes'] = getMessage(CTRL_RQS_RUNTIME_FLTR_TYPE_MENU_LBL);
        $this->parms['{filter name}'] = new UrlParam(getMessage(FILTER_NAME_LBL), '{filter name}', false, getMessage(SETS_CUST_MENU_PD_SELECTED_IDX_LBL), 'customMenu/22');
    }

    function getData()
    {
        if ($this->data['attrs']['filter_name'] === '')
        {
            echo $this->reportError(getMessage(FILTER_NAME_ATTRIB_CONTAIN_VALUE_MSG));
            return false;
        }

        $this->CI->load->model( 'custom/ContactPermissions_model' );
        $this->data['stateJurisdiction'] = $this->CI->ContactPermissions_model->stateJurisdiction();

        $list = array();
        $this->CI->load->model('custom/Report_model2');
        setFiltersFromUrl($this->data['attrs']['report_id'], $allFilters);
        $filters = $this->CI->Report_model2->getFilterByName($this->data['attrs']['report_id'], $this->data['attrs']['filter_name']);
        $list = optlistGet(OPTL_PROVINCES);
        // get values
        $i = 0;
        foreach ($list as $key => $value)
        {
            if (is_int($key))
            {
                if( $this->data['stateJurisdiction'] == '' || $this->data['stateJurisdiction'] === $value )
                {
                    $optl[$i]['id'] = $value;
                    $optl[$i]['label'] = $value;
                    $i++;
                }
            }
        }
        $parm = $allFilters[$this->data['attrs']['filter_name']]->filters->data[0];
        $this->data['js'] = array('filters' => $filters,
                                  'name' => $filters['prompt'],
                                  'list' => $optl,
                                  'defaultValue' => $parm ? $parm : $filters['default_value']
                                  );

        $this->data['js']['rnSearchType'] = 'filterDropdown';
        $this->data['js']['searchName'] = $this->data['attrs']['filter_name'];
    }
}

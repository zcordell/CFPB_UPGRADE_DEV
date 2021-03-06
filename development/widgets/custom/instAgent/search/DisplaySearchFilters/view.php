<rn:meta controller_path="custom/instAgent/search/DisplaySearchFilters" js_path="standard/search/DisplaySearchFilters" base_css="standard/search/DisplaySearchFilters" presentation_css="widgetCss/DisplaySearchFilters.css" compatibility_set="November '09+"/>

<div id="rn_<?=$this->instanceID;?>" class="rn_DisplaySearchFilters <?=$this->data['widgetClass'];?>">
<span class="rn_Heading"><?=$this->data['attrs']['label_title'];?></span>
<? for($i = 0; $i < count($this->data['js']['filters']); $i++):?>
    <div id="rn_<?=$this->instanceID . '_Filter_' . $i;?>" class="rn_Filter">
        <div class="rn_Label"><?=$this->data['js']['filters'][$i]['label'];?>
        <a id="rn_<?=$this->instanceID .'_Remove_' . $i?>" title="<?=$this->data['attrs']['label_filter_remove'];?>" href="javascript:void(0);">
        <? if($this->data['attrs']['remove_icon_path']):?>
            <img src="<?=$this->data['attrs']['remove_icon_path'];?>" alt="<?=$this->data['attrs']['label_filter_remove'];?>"/>
        <? else:?>
            <?=$this->data['attrs']['label_filter_remove'];?>
        <? endif;?>
        </a>
        </div>
        <? foreach($this->data['js']['filters'][$i]['data'] as $index => $filter):?>
        <? $class = ($index === count($this->data['js']['filters'][$i]['data']) - 1) ? 'rn_Selected' : '';
             $link = $this->data['js']['searchPage'] . $this->data['js']['filters'][$i]['linkType'] . '/' . $filter['hierList'];?>
        <a href="<?=$link;?>" class="rn_FilterItem <?=$class;?>" id="rn_<?=$this->instanceID;?>_Filter<?=$filter['value']?>"><?=$filter['label'];?></a>
        <span class="rn_Separator <?=$class;?>"></span>
        <? endforeach;?>
    </div>
<? endfor;?>
</div>
        

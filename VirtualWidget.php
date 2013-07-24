<?php

/**
 * Virtual Widget
 */
class VirtualWidget	extends	Widget{

	static $has_one = array(
		"ActualWidget" => "Widget"
	);

	static $title = null; //don't show a title for this widget
	static $cmsTitle = "Virtual";
	static $description = "Display an exact copy of an existing widget";

	function getCMSFields(){
		$widgets = Widget::get()->map()->toArray();
		return new FieldList(
			DropdownField::create("ActualWidgetID","Existing Widget",$widgets)
		);
	}

	function WidgetHolder(){
		if($widget = $this->ActualWidget()){
			$widget->ID = $this->ID;
			return $widget->WidgetHolder();
		}
		return parent::WidgetHolder();
	}

}
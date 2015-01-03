# Flexible Content Field

Creates flexible content widget. Relies on ACF and Timber. 

To override the template create corresponding templates in your themes views/flexible_content_widget dir

To override one specific entry create a template that matches

'flexible_content_widget/flexible_content_widget_' . $widget_id . '.twig'

where widget_id is eg "flex_widget-3" (look in the widget li's class list using inspector)

similarly for a specific content type you can use 

'flexible_content_widget/content/' ~ item.template ~ '.twig'

where template is a field for the content type. See the included banner type. 
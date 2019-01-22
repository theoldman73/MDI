if (!window.app) {
  window.app = {};
}
var app = window.app;
var DivSubLayer;
/**
 * @class
 * The LayersControl is a layer switcher that can be configured with groups.
 * A minimal configuration is:
 *
 *     new app.LayersControl()
 *
 * In this case, all layers are shown with checkboxes and in a single list.
 * If you want to group layers in separate lists, you can configure the control
 * with a groups config option, for example:
 *
 *     new app.LayersControl({
 *       groups: {
 *         background: {
 *           title: "Base Layers",
 *           exclusive: true
 *         },
 *         default: {
 *           title: "Overlays"
 *         }
 *       }
 *     })
 *
 * Layers that have their 'group' property set to 'background', will be part of
 * the first list. The list will be titled 'Base Layers'. The title is
 * optional. All other layers will be part of the default list. Configure a
 * group with exclusive true to get a radio group.
 *
 * @constructor
 * @extends {ol.control.Control}
 * @param {Object} opt_options Options.
 */
app.LayersControl = function(opt_options) {
  this.defaultGroup = "default";
  var options = opt_options || {};
  var element = document.createElement('div');
  element.id="LayerControl";
  element.className = 'layers-control ol-unselectable';
  if (options.groups) {
    this.groups = options.groups;
    if (!this.groups[this.defaultGroup]) {
      this.groups[this.defaultGroup] = {};
    }
  } else {
    this.groups = {};
    this.groups[this.defaultGroup] = {};
  }
  this.containers = {};
var x=0;
  for (var group in this.groups) {
     DivSubLayer= document.createElement('div');
    x+=1;
    DivSubLayer.id ="Sub"+ x.toString();
    this.containers[group] = document.createElement('ul');
       if (this.groups[group].title) {
      $(this.containers[group]).html(this.groups[group].title);
    }
    this.containers[group].appendChild(DivSubLayer);
    element.appendChild(this.containers[group]);
  }

  ol.control.Control.call(this, {
    element: element,
    target: options.target
  });
};

ol.inherits(app.LayersControl, ol.control.Control);

/**
 * Remove the control from its current map and attach it to the new map.
 * Here we create the markup for our layer switcher component.
 * @param {ol.Map} map Map.
 */
app.LayersControl.prototype.setMap = function(map) {
  ol.control.Control.prototype.setMap.call(this, map);
  var layers = map.getLayers().getArray();
  for (var i=0, ii=layers.length; i < ii; ++i) {
    var layer = layers[i];
    var title = layer.get('title');
    var id = layer.get('id');
    var img=layer.get('img');
    var group = layer.get('group') || this.defaultGroup;
    if (title) {
      //alert(title);
      var item = document.createElement('li');
      if (this.groups[group] && this.groups[group].exclusive === true) {
        $('<span />').html(title).appendTo(item);
        $('<input />', {type: 'radio',id:id, name: group, value: title, checked:
            layer.getVisible()}).
            change([map, layer, group], function(evt) {
              var map = evt.data[0];
              var layers = map.getLayers().getArray();
              for (var i=0, ii=layers.length; i<ii; ++i) {
                if (layers[i].get("group") == evt.data[2]) {
                  layers[i].setVisible(false);
                }
              }
              var layer = evt.data[1];
              layer.setVisible($(this).is(':checked'));
            }).appendTo(item);
        document.getElementById('Sub1').appendChild(item);
      } else {

        $('<span />',{id:id+1}).html(title).appendTo(item);
        //$('<img />',{src:img}).appendTo(item);
        $('<input />', {type: 'checkbox',id:id, checked: layer.getVisible()}).
            change(layer, function(evt) {
              evt.data.setVisible($(this).is(':checked'));
            }).appendTo(item);

        if (this.containers[group]) {
          document.getElementById('Sub2').appendChild(item);
        } else if (this.containers[this.defaultGroup]) {
          document.getElementById('Sub2')[this.defaultGroup].appendChild(item);
        }
      }
    }
  }
};

/**
 * @copyright (C) FIT-Media.com, {@link http://fit-media.com}
 * Date: 12/24/2015, Time: 4:12 PM
 * The MIT License (MIT) https://github.com/m00nk/tableDragAndDrop/blob/master/LICENSE
 * @author Dmitrij "m00nk" Sheremetjev <m00nk1975@gmail.com>
 * @package
 */

(function($){
    $.fn.disableSelection = function() {
        return this
        .attr('unselectable', 'on')
        .css('user-select', 'none')
        .css('-moz-user-select', 'none')
        .css('-khtml-user-select', 'none')
        .css('-webkit-user-select', 'none')
        .on('selectstart', false)
        .on('contextmenu', false)
        .on('keydown', false)
        .on('mousedown', false);
    };
    $.fn.enableSelection = function() {
        return this
        .attr('unselectable', '')
        .css('user-select', '')
        .css('-moz-user-select', '')
        .css('-khtml-user-select', '')
        .css('-webkit-user-select', '')
        .off('selectstart', false)
        .off('contextmenu', false)
        .off('keydown', false)
        .off('mousedown', false);
    };
})(jQuery);

(function($)
{
  var movableObject = {
    active: false,
    srcTable: null,
    fakeObj: null,
    lastX: 0,
    lastY: 0,
    startIndex: 0,
    lastIndex: 0,
    arrow: null
  };

  $.fn.tabledragdrop = function(callerSettings)
  {
    var settings = $.extend({
            onStartDrag: null, // function(table, index, mode), mode = ['horiz', 'vert']
            onDrop: null       // function(startIndex, dropIndex, mode), mode = ['horiz', 'vert']
        }, callerSettings || {}),
        tables = $(this).filter('table');
    ;
    tables.find( 'thead th:not([class*=noDrag])' ).on( 'mousedown', colOnMouseDown );
    tables.find( 'tbody th:not([class*=noDrag])' ).on( 'mousedown', rowOnMouseDown );

    //-----------------------------------------
    function colOnMouseDown(ev)
    {
      if(!movableObject.active && ev.target.tagName.toLowerCase() == 'th')
      {
        movableObject.lastX = ev.pageX;
        movableObject.lastY = ev.pageY;

        var trg = $(ev.target);
        var tableContEl = trg.parents( 'table' ).parent();
        if(!trg.is('th')) trg = $(trg.parents('th')[0]);

        movableObject.startIndex = movableObject.lastIndex = trg.prop('cellIndex');
        movableObject.srcTable = $(trg.parents('table')[0]);
        _createVertTable( tableContEl );
        movableObject.fakeObj.css('width', trg.outerWidth() + 'px');
        movableObject.fakeObj.appendTo( tableContEl );

        if(settings.onStartDrag) settings.onStartDrag(movableObject.srcTable, movableObject.lastIndex, 'horiz');

        disableSelection($(document).css('cursor', 'move')
          .on('mousemove', colOnMouseMove)
          .one('mouseup', colOnMouseUp));
      }
    }

    function colOnMouseUp(ev)
    {
      enableSelection($(document).css({cursor: 'auto'}).unbind('mousemove'));

      movableObject.srcTable.find('.drag_freeze').removeClass('drag_freeze');

      movableObject.active = false;

      movableObject.fakeObj.remove();
      movableObject.fakeObj = null;

      movableObject.arrow.remove();
      movableObject.arrow = null;

      if(movableObject.startIndex != movableObject.lastIndex && movableObject.startIndex != movableObject.lastIndex + 1)
      {
        movableObject.srcTable.find('tr').each(function()
        {
          $(this).find('td').add($(this).find('th')).each(function()
          {
            if(this.cellIndex == movableObject.startIndex)
            {
              var s = $(this);
              s.siblings().each(function()
              {
                if(this.cellIndex == movableObject.lastIndex)
                { // переносим
                  s.insertAfter($(this));
                  return false;
                }
              });
              return false;
            }

          });
        });
        if(settings.onDrop)
          settings.onDrop(movableObject.startIndex, movableObject.lastIndex, 'horiz');
      }
    }

    function colOnMouseMove(ev)
    {
      if(movableObject.active)
      {
        var dx = movableObject.lastX - ev.pageX;
        movableObject.lastX = ev.pageX;

        var p = movableObject.fakeObj.position();
        var x = p.left - dx;

        movableObject.fakeObj.css('left', x + 'px');

        var cells = $(movableObject.srcTable.find('tbody tr')[0]).find('td');

        cells.each(function(i)
        {
          var cell = $(this);
          var cp = cell.position();
          var x1 = cp.left;
          var x2 = x1 + cell.outerWidth();
          if(i == 0 && x1 >= x)
          {
            movableObject.arrow.css('left', x1 - 8 + 'px');
            movableObject.lastIndex = this.cellIndex - 1;
            return false;
          }
          if(x1 <= x && x <= x2)
          {
            movableObject.arrow.css('left', x2 - 8 + 'px');
            movableObject.lastIndex = this.cellIndex;
            return false;
          }
        });
      }
    }

    function rowOnMouseDown(ev)
    {
      if(!movableObject.active && ev.target.tagName.toLowerCase() == 'th')
      {
        movableObject.lastX = ev.pageX;
        movableObject.lastY = ev.pageY;

        var trg = $($(ev.target).parents('tr')[0]);
        var tableContEl = trg.parents( 'table' ).parent();
        movableObject.startIndex = movableObject.lastIndex = trg.prop('rowIndex');
        movableObject.srcTable = $(trg.parents('table')[0]);
        _createHorizTable( tableContEl );
        movableObject.fakeObj.css('width', trg.outerWidth() + 'px');
        movableObject.fakeObj.appendTo( tableContEl );

        if(settings.onStartDrag) settings.onStartDrag(movableObject.srcTable, movableObject.lastIndex, 'vert');

        disableSelection($(document).css('cursor', 'move')
          .on('mousemove', rowOnMouseMove)
          .one('mouseup', rowOnMouseUp));
      }
    }

    function rowOnMouseUp(ev)
    {
      enableSelection($(document).css({cursor: 'auto'}).unbind('mousemove'));

      movableObject.srcTable.find('.drag_freeze').removeClass('drag_freeze');

      movableObject.active = false;

      movableObject.fakeObj.remove();
      movableObject.fakeObj = null;

      movableObject.arrow.remove();
      movableObject.arrow = null;


      if(movableObject.startIndex != movableObject.lastIndex && movableObject.startIndex != movableObject.lastIndex + 1)
      {
        var s = movableObject.srcTable.find('tr:eq(' + movableObject.startIndex + ')');
        var d = movableObject.srcTable.find('tr:eq(' + movableObject.lastIndex + ')');
        if($(d.parents('tbody')[0]).is('tbody'))
          s.insertAfter(d);
        else
          s.insertBefore($(movableObject.srcTable.find('tbody tr')[0]));
        if(settings.onDrop)
          settings.onDrop(movableObject.startIndex, movableObject.lastIndex, 'vert');
      }
    }

    function rowOnMouseMove(ev)
    {
      if(movableObject.active)
      {
        var dy = movableObject.lastY - ev.pageY;
        movableObject.lastY = ev.pageY;

        var p = movableObject.fakeObj.position();
        var y = p.top - dy;

        movableObject.fakeObj.css('top', y + 'px');

        movableObject.srcTable.find('tbody tr').each(function(i)
        {
          var row = $(this);

          var rp = row.position();
          var y1 = rp.top;
          var y2 = y1 + row.outerHeight();
          if(i == 0 && y1 >= y)
          {
            movableObject.arrow.css('top', y1 - 8 + 'px');
            movableObject.lastIndex = this.rowIndex - 1;
            return false;
          }
          if(y1 <= y && y <= y2)
          {
            movableObject.arrow.css('top', y2 - 8 + 'px');
            movableObject.lastIndex = this.rowIndex;
            return false;
          }
        });

      }
    }

    function _createHorizTable( tableContEl )
    {
      movableObject.fakeObj = $('<table class="ghost" ' + _getElementAttributes(movableObject.srcTable) + '></table>')
        .css({'opacity': 0.75, 'margin': 0, 'display': 'block'});
      var tr = $('<tr>').appendTo(movableObject.fakeObj);

      movableObject.arrow = $('<div class="arrow_right"></div>').appendTo( tableContEl );
      movableObject.active = true;

      var flag = true;

      movableObject.srcTable.find('tr:eq(' + movableObject.startIndex + ')').children().each(function()
      {
        var c = $(this);
        if(flag)
        {
          var p = c.position();

          movableObject.fakeObj.css({'left': p.left + 20 + 'px', 'top': p.top + 'px'});
          movableObject.arrow.css({'left': p.left - 16 + 'px', 'top': p.top - 8 + 'px'});
          flag = false;
        }
        var clonedEl = c.clone();
        clonedEl.css( 'width', c.outerWidth() );
        clonedEl.appendTo(tr);
        c.addClass('drag_freeze');
      });
    }

    function _createVertTable( tableContEl )
    {
      movableObject.fakeObj = $('<table class="ghost" ' + _getElementAttributes(movableObject.srcTable) + '></table>')
        .css({'opacity': 0.75, 'margin': 0, 'display': 'block'});
      movableObject.arrow = $('<div class="arrow_down"></div>').appendTo( tableContEl );
      movableObject.active = true;

      var flag = true;
      var firstCell = true;

      movableObject.srcTable.find('th').add(movableObject.srcTable.find('td')).each(function()
      {
        if(this.cellIndex == movableObject.startIndex)
        {
          var c = $(this);
          if(flag)
          {
            var p = c.position();

            movableObject.fakeObj.css({'left': p.left + 'px', 'top': p.top + 10 + 'px'});
            movableObject.arrow.css({'left': p.left - 8 + 'px', 'top': p.top - 16 + 'px'});
            flag = false;
          }

          var tr = $('<tr>').appendTo(movableObject.fakeObj);
          var clonedEl = c.clone();

          if( firstCell ) {
              firstCell = false;
              clonedEl.css( 'width', c.outerWidth() );
          }

          clonedEl.css( 'height', c.outerHeight() );
          clonedEl.appendTo(tr);
          c.addClass('drag_freeze');
        }
      });
    }

    function _getElementAttributes(element)
    {
      var attrsString = '',
        attrs = element[0].attributes;
      for(var i = 0, length = attrs.length; i < length; i++)
      {
        attrsString += attrs[i].nodeName + '="' + attrs[i].nodeValue + '"';
      }
      return attrsString;
    }

    function disableSelection(obj)
    {
      var e = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
      obj.disableSelection();
      return function()
      {
        return obj.on(e + ".ui-disableSelection", function(e){e.preventDefault()})
      }
    }

    function enableSelection(obj)
    {
      obj.enableSelection();
      return obj.unbind(".ui-disableSelection")
    }
  }
})(jQuery);
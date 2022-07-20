/*!
 * jQuery serialtabs
 * https://github.com/kevinmeunier/jquery-serialtabs
 *
 * Copyright 2022 Meunier Kévin
 * https://www.meunierkevin.com
 *
 * Released under the MIT license
 */
(function($){
  'use strict';

  $.fn.serialtabs = function(options){
    const settings = $.extend({}, $.fn.serialtabs.defaults, options);
    const base = this;

    $.extend(this, {
      init: function(){
        const event = settings.event+'.serialtabs';
        const fxIn = settings.fxIn;
        settings.fxIn = 'show';
        let $lists = $(this);

        this.each(function(){
          const $list = $(this);
          const $trigger = settings.getTrigger($list);
          const $triggerCurrent = $trigger.filter('.is-current');

          // Responsive design management
          if( settings.mode == 'auto' ){
            let delay = false;
            let speed;
            $(window).on('resize.serialtabs', function(event, speed){
              if( delay !== false )
                clearTimeout(delay);

              delay = setTimeout(function(){
                base.handleResize($list);
              }, 25);
            });

            // Manual trigger on load
            base.handleResize($list);
          } else {
            $list.attr('data-serialtabs-mode', settings.mode);
          }

          // Show the first element, or the current element
          if( $list.attr('data-serialtabs-mode') == 'tabs' && $triggerCurrent.length == 0 ){
            $trigger.first().addClass('is-current');
          }

          // Hide all elements on page load
          $trigger.not('.is-current').each(function(){
            const $this = $(this);
            const $target = settings.getTarget($this);
            $target.hide();
          });

          // Bind event
          $trigger.on(event, function(event){
            const $this = $(this);
            base.handleEvent($this, $list);
            if( event.target.tagName == 'A' )
              return true;
          });
        });

        // Restore the initial setting
        settings.fxIn = fxIn;
      },

      handleEvent: function( $trigger, $list ){
        const $target = settings.getTarget($trigger);
        const $triggers = settings.getTrigger($list);
        const $prevTrigger =  $triggers.filter('.is-current');
        const $prevTarget = settings.getTarget($prevTrigger);

        // Avoid triggering the event for already displayed elements
        if( $list.attr('data-serialtabs-mode') == 'tabs' && $trigger.is($prevTrigger) )
          return;

        // Hide the previous element
        if( $prevTrigger )
          base.display($prevTrigger, $prevTarget, false);

        // Show the new element
        if( !$trigger.is($prevTrigger) )
          base.display($trigger, $target, true);
      },

      display: function( $trigger, $target, action ){
        // Management of the current class
        $trigger[action ? 'addClass' : 'removeClass']('is-current');

        // Management of the display state
        $target[action ? settings.fxIn : settings.fxOut]();

        // Check the radio button if existing
        if( action ){
          const $radio = $trigger.find('[type=radio]');
          if( $radio.length )
            $radio.prop('checked', true);
        }
      },

      getTrigger: function( $list ){
        let trigger;

        if( typeof settings.trigger  == 'string' ){
          trigger = $list.find( settings.trigger );
        } else if( typeof settings.trigger  == 'function' ){
          trigger = settings.trigger( $list );
        }

        return $(trigger);
      },

      getTarget: function( $trigger ){
        let target;

        if( typeof settings.target  == 'string' ){
          target = $trigger.attr( settings.target );
        } else if( typeof settings.target  == 'function' ){
          target = settings.target( $trigger );
        }

        return $(target);
      },

      handleResize: function( $list ){
        const isResponsive = base.isResponsive($list);

        // Update the display mode
        $list.attr('data-serialtabs-mode', (isResponsive ? 'accordion' : 'tabs'));

        // Move the content
        base.moveItems($list, isResponsive);
      },

      isResponsive: function( $list ){
        let breakpoint = $list.data('serialtabs-breakpoint') ? $list.data('serialtabs-breakpoint') : 50;

        // Breakpoint calculation
        if( breakpoint == 50 )
          $list.children().each(function(){
            breakpoint += $(this).outerWidth();
          });

        // Store the breakpoint (essential)
        $list.data('serialtabs-breakpoint', breakpoint);

        return ( $list.parent().width() < breakpoint );
      },

      moveItems: function( $list, isResponsive ){
        const $trigger = settings.getTrigger($list);

        $trigger.each(function(){
          const $this = $(this);
          const $target = settings.getTarget($this);

          if( isResponsive ){
            $target.insertAfter($this);
          } else {
            $target.insertAfter($list);
          }
        });
      }
    });

    // Initialisation
    this.init();
    return this;
  };

  $.fn.serialtabs.defaults = {
    mode: 'auto', // 'auto', 'accordion', 'tabs'
    event: 'click',
    getTrigger: function($list){
      return $list.find('[data-serialtabs]');
    },
    getTarget: function($trigger){
      return $($trigger.data('serialtabs'));
    },
    fxIn: 'slideDown',
    fxOut: 'slideUp'
  };
}(jQuery));

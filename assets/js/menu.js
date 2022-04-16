class beatonthebratScheduleHandler extends elementorModules.frontend.handlers.Base {
   
    getDefaultSettings() {
       
        return {
            selectors: {
                hours: '.working-hours',
            },
        };
    }
 
    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            
            $hours: this.$element.find( selectors.hours )
        };
    }


    reverseRows( e ) {
        console.log('reverse rows');
        var table = this.elements.$hours;
        var tbody = table.find('tbody');
        var arr = jQuery.makeArray(jQuery("tr",tbody[0]).detach());
        arr.reverse();
        tbody.html('');
        tbody.append(arr);
    }

    alertIt(){
        alert('KUKKKENNN');
    }
    
    bindEvents() {
        //console.log(this.$element);
        this.elements.$hours.find('th.day').on( 'click', this.reverseRows.bind(this));
        this.$element.find('.tets').on('click', this.alertIt.bind(this)); // yey
        
    }
 }

 jQuery( window ).on( 'elementor/frontend/init', () => {
    elementorFrontend.elementsHandler.attachHandler( 'beatonthebrat-menu', beatonthebratScheduleHandler );
    // here is a place to stick normal scripts
    // alert('hohoohooo');
 } );

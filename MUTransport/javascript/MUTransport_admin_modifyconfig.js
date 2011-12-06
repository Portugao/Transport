/*
 *  $Id: MUTransport_admin_modifyconfig.js 34 3.10.2010 14:31 MU(+) Beratung $ 
 */

/**
 * create the onload function to enable the respective functions
 *
 */
Event.observe(window, 
              'load', 
              MUTransport_modifyconfig_init_check,
              false);

function MUTransport_modifyconfig_init_check() 
{

    if ($('mutransport_paged_details')) {
    	mutransport_paged_init();
    }
    if ($('mutransport_reviews_details')) {
    	mutransport_reviews_init();
    }
    if ($('mutransport_wordpress_details')) {
    	mutransport_wordpress_init();
    }
}


function mutransport_paged_init()
{
    if ($('MUTransport_pagedtocontent').checked == false && $('MUTransport_pagedtonews').checked == false) {
        $('mutransport_paged_details').hide();
        $state = 'hide';
    }
    else {
    	$state = 'show';
    }
    
    Event.observe('MUTransport_pagedtocontent', 'change', mutransport_paged_onchange);
    Event.observe('MUTransport_pagedtonews', 'change', mutransport_paged_onchange2);
}

function mutransport_paged_onchange()
{
	if($state == 'hide') {
      if ($('MUTransport_pagedtocontent').checked == true || $('MUTransport_pagedtonews').checked == true) {
         switchdisplaystate('mutransport_paged_details');
         $state = 'show';
    }
	}
	if($state == 'show') {
	  if ($('MUTransport_pagedtocontent').checked == false && $('MUTransport_pagedtonews').checked == false) {
	     switchdisplaystate('mutransport_paged_details');
	     $state = 'hide';		
	}
}
	
}

function mutransport_paged_onchange2()
{
	if($state == 'hide') {
      if ($('MUTransport_pagedtocontent').checked == true || $('MUTransport_pagedtonews').checked == true) {
         switchdisplaystate('mutransport_paged_details');
         $state = 'show';
    }
	}
	if($state == 'show') {
	  if ($('MUTransport_pagedtocontent').checked == false && $('MUTransport_pagedtonews').checked == false) {
	     switchdisplaystate('mutransport_paged_details');
	     $state = 'hide';		
	}
}
	
}

function mutransport_reviews_init()
{
    if ($('MUTransport_reviewstocontent').checked == false) {
        $('mutransport_reviews_details').hide();
    }  
    Event.observe('MUTransport_reviewstocontent', 'change', mutransport_reviews_onchange);
}
    
    function mutransport_reviews_onchange()
    {
    	switchdisplaystate('mutransport_reviews_details');
    	
    }

function mutransport_wordpress_init()
{
    if ($('MUTransport_wordpress').checked == false) {
        $('mutransport_wordpress_details').hide();
    }  
    Event.observe('MUTransport_wordpress', 'change', mutransport_wordpress_onchange);
}
    
    function mutransport_wordpress_onchange()
    {
    	switchdisplaystate('mutransport_wordpress_details');
    	
    }
  
        
        var state=false;
        function allboxes()
        {
            var elements=document.getElementsByName("yes[]");

            if(state==false)
            {
                for(i=0;i<elements.length;i++)
                {
                    elements[i].checked=true;
                    state=true;
                }
            }
            else
            {
                for(i=0;i<elements.length;i++)
                {
                    elements[i].checked=false;
                    state=false;
                }
            }
        }
        
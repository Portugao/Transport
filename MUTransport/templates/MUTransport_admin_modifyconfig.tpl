{*  $Id: MUTransport_admin_modifyconfig.htm 2009-12-29 09:23:00 MU $  *}
{ajaxheader modname='MUTransport' filename='MUTransport_admin_modifyconfig.js' effects=true nobehaviour=true noscriptaculous=true}
{if $news_state eq 2}
{gt text='published' assign='newsstate'}
{/if}
{if $news_state eq 4}
{gt text='waiting' assign='newsstate'}
{/if}
{if $news_state eq 6}
{gt text='draft' assign='newsstate'}
{/if}
{include file="MUTransport_admin_header.tpl"}
<div class="z-admincontainer">
<div class="z-adminpageicon">{pnimg modname=core src=configure.gif set=icons/large __alt='Settings' }</div>
<h2>{gt text="Settings"}</h2>
<div class="mutransport_warning">{gt text="Attention ! Disable a module will delete the pages of the module in page view and the module in the module view !"}<br />
{gt text="PagEd will only be deleted, if you disable both of the options for this module !"}</div>
<form class="z-form" action="{pnmodurl modname='MUTransport' type='admin' func='updateconfig'}"
method="post" enctype="application/x-www-form-urlencoded">
<div><input type="hidden" name="authid" value="{insert name="generateauthkey" module="Blocks"}" />
<div id="mutransport_modules">
<fieldset><legend>{gt text="For modules"}</legend>
<fieldset><legend>{gt text="General settings"}</legend>
<div class="z-formrow"><label for="MUTransport_newstocontent">{gt text="Enable transport News to Content"}</label>
{if $newstocontent eq 1} <input id="MUTransport_newstocontent"
	name="newstocontent" type="checkbox" value="1" checked="checked" /> {else}
<input id="MUTransport_newstocontent" name="newstocontent"
	type="checkbox" value="1" /> {/if}</div>
<div class="z-formrow"><label for="MUTransport_pagestocontent">{gt text="Enable transport Pages to Content"}</label>
{if $pagestocontent eq 1} <input id="MUTransport_pagestocontent"
	name="pagestocontent" type="checkbox" value="1" checked="checked" /> {else}
<input id="MUTransport_pagestocontent" name="pagestocontent"
	type="checkbox" value="1" /> {/if}</div>
<div class="z-formrow"><label for="MUTransport_pagedtocontent">{gt text="Enable transport PagEd to Content"}</label>
{if $pagedtocontent eq 1} <input id="MUTransport_pagedtocontent"
	name="pagedtocontent" type="checkbox" value="1" checked="checked" /> {else}
<input id="MUTransport_pagedtocontent" name="pagedtocontent"
	type="checkbox" value="1" /> {/if}</div>
<div class="z-formrow"><label for="MUTransport_pagedtonews">{gt text="Enable transport PagEd to News"}</label>
{if $pagedtonews eq 1} <input id="MUTransport_pagedtonews"
	name="pagedtonews" type="checkbox" value="1" checked="checked" /> {else}
<input id="MUTransport_pagedtonews" name="pagedtonews" type="checkbox"
	value="1" /> {/if}</div>	
<div class="z-formrow"><label for="MUTransport_reviewstocontent">{gt text="Enable transport Reviews to Content"}</label>
{if $reviewstocontent eq 1} <input
	id="MUTransport_reviewstocontent" name="reviewstocontent"
	type="checkbox" value="1" checked="checked" /> {else} <input
	id="MUTransport_reviewstocontent" name="reviewstocontent"
	type="checkbox" value="1" /> {/if}</div>	
<div class="z-formrow"><label for="MUTransport_contenttocontent">{gt text="Enable copy Content to Content"}</label>
{if $contenttocontent eq 1} <input
	id="MUTransport_contenttocontent" name="contenttocontent"
	type="checkbox" value="1" checked="checked" /> {else} <input
	id="MUTransport_contenttocontent" name="contenttocontent"
	type="checkbox" value="1" /> {/if}</div>
<div class="z-formrow"><label for="MUTransport_textformat"
	id="MUTransport_textformat">{gt text="Format of transport"}(
{$text_format} {gt text="active "} )</label> {if $text_format}
<select class="mutransport_form" name="text_format" size="1">
	{if $text_format eq 'text'}
	<option class="mutransport_selected" selected value="text">text</option>
	<option value="html">html</option>
	{/if}
	{if $text_format eq 'html'}
	<option value="text">text</option>
	<option class="mutransport_selected" selected value="html">html</option>
	{/if}
</select> {else} <select class="mutransport_form" name="text_format"
	size="1">
	<option value="">{gt text="please select"}</option>
	<option value="text">text</option>
	<option value="Html">html</option>
</select> {/if}</div>
</fieldset>
<fieldset><legend>{gt text="Specific settings for start modules"}</legend>
<div id="mutransport_paged_details">
<div class="z-formrow"><label for="MUTransport_imagepath">{gt text="The image path for PagEd"}</label>
{if $image_path} <input id="MUTransport_imagepath"
	class="mutransport_form" name="image_path" type="text" value="{$image_path}"
size="20" /> {else} <input id="MUTransport_imagepath"
	class="mutransport_form" name="image_path" type="text" value=""
	size="20" /> {/if}</div>
</div>
<div id="mutransport_reviews_details">
<div class="z-formrow"><label for="MUTransport_details">{gt text="Enable transport of details for Reviews"}</label>
{if $details eq 1} <input id="MUTransport_details"
	name="details" type="checkbox" value="1" checked="checked" /> {else}
<input id="MUTransport_details" name="details" type="checkbox"
	value="1" /> {/if}</div>	
</div>
</fieldset>

</fieldset></div>
<div id="mutransport_cms">
<fieldset><legend>{gt text="For CMS"}</legend>
<fieldset><legend>{gt text="General settings"}</legend>
<div class="z-formrow"><label for="MUTransport_newstocontent">{gt text="Enable transport wordpress to Zikula"}</label>
{if $wordpress eq 1} <input id="MUTransport_wordpress"
	name="wordpress" type="checkbox" value="1" checked="checked" /> {else}
<input id="MUTransport_wordpress" name="wordpress"
	type="checkbox" value="1" /> {/if}</div>
</fieldset>
<div id="mutransport_wordpress_details">
<fieldset><legend>{gt text="Specific settings for wordpress"}</legend>
<div class="z-formrow"><label for="MUTransport_host">{gt text="The name of the host"}</label>
{if $wordpress_host} <input id="MUTransport_host"
	class="mutransport_form" name="wordpress_host" type="text" value="{$wordpress_host}"
size="20" /> {else} <input id="MUTransport_host"
	class="mutransport_form" name="wordpress_host" type="text" value=""
	size="20" /> {/if}</div>
<div class="z-formrow"><label for="MUTransport_db">{gt text="The name of the database"}</label>
{if $wordpress_db} <input id="MUTransport_db"
	class="mutransport_form" name="wordpress_db" type="text" value="{$wordpress_db}"
size="20" /> {else} <input id="MUTransport_db"
	class="mutransport_form" name="wordpress_db" type="text" value=""
	size="20" /> {/if}</div>
<div class="z-formrow"><label for="MUTransport_user">{gt text="The name of the database user"}</label>
{if $wordpress_user} <input id="MUTransport_user"
	class="mutransport_form" name="wordpress_user" type="text" value="{$wordpress_user}"
size="20" /> {else} <input id="MUTransport_user"
	class="mutransport_form" name="wordpress_user" type="text" value=""
	size="20" /> {/if}</div>
<div class="z-formrow"><label for="MUTransport_pw">{gt text="The password of the database"}</label>
{if $wordpress_pw} <input id="MUTransport_pw"
	class="mutransport_form" name="wordpress_pw" type="password" value="{$wordpress_pw}"
size="20" /> {else} <input id="MUTransport_pw"
	class="mutransport_form" name="wordpress_pw" type="password" value=""
	size="20" /> {/if}</div>
<div class="z-formrow"><label for="MUTransport_db">{gt text="The prefix of the wordpress database"}</label>
{if $wordpress_prefix} <input id="MUTransport_prefix"
	class="mutransport_form" name="wordpress_prefix" type="text" value="{$wordpress_prefix}"
size="20" /> {else} <input id="MUTransport_prefix"
	class="mutransport_form" name="wordpress_prefix" type="text" value=""
	size="20" /> {/if}</div>
<div class="z-formrow"><label for="MUTransport_ezcomments">{gt text="Enable the transport of comments"}</label>
{if $wordpress_ezcomments eq 1} <input id="MUTransport_ezcomments"
	class="mutransport_form" name="wordpress_ezcomments" type="checkbox" value="1" checked="checked" /> {else} <input id="MUTransport_ezcomments"
	class="mutransport_form" name="wordpress_ezcomments" type="checkbox" value="1"/> {/if}</div>
<div class="z-formrow"><label for="MUTransport_clearing">{gt text="Enable the clearing of urls"}</label>
{if $wordpress_clearing eq 1} <input id="MUTransport_clearing"
	class="mutransport_form" name="wordpress_clearing" type="checkbox" value="1" checked="checked" /> {else} <input id="MUTransport_clearing"
	class="mutransport_form" name="wordpress_clearing" type="checkbox" value="1"/> {/if}</div>
</fieldset>
<fieldset><legend>{gt text="Specific settings for Pages"}</legend>
<div class="z-formrow"><label for="MUTransport_imagepath2">{gt text="The image path for Pages"}</label>
{if $image_path2} <input id="MUTransport_imagepath2"
	class="mutransport_form" name="image_path2" type="text" value="{$image_path2}"
size="20" /> {else} <input id="MUTransport_imagepath2"
	class="mutransport_form" name="image_path2" type="text" value=""
	size="20" /> {/if}</div>
</fieldset>
</div>
</fieldset></div>
<div id="mutransport_general_target_modules">
<fieldset><legend>{gt text="General settings for target modules"}</legend>
<div class="z-formrow"><label for="MUTransport_state"
	id="MUTransport_state">{gt text="The state you wish for transport to News "}(<span id="MUTransport_newsmessage">
{$newsstate} {gt text="active "} </span>)</label> 
<select class="mutransport_form" name="news_state"
	size="1">
	{if $news_state neq 2 && $news_state neq 4 && $news_state neq 6}
	<option value="">{gt text="please select"}</option>

	{else}
	{if $news_state eq 2}
	<option value="2" selected>{gt text="published"}</option>
	{else}
	<option value="2">{gt text="published"}</option>
	{/if}
	{if $news_state eq 4}	
	<option value="4" selected>{gt text="waiting"}</option>
    {else}
	<option value="4">{gt text="waiting"}</option>
    {/if}
	{if $news_state eq 6}
	<option value="6" selected>{gt text="draft"}</option>
	{else}
	<option value="6">{gt text="draft"}</option>
    {/if}
    {/if}
</select></div>
</fieldset>
</div>
<div class="z-formbuttons">{pnbutton src=button_ok.gif set=icons/small __alt="Save" __title="Save"}
<a href="{pnmodurl modname=MUTransport type=admin func=view}">{pnimg modname=core src=button_cancel.gif set=icons/small __alt="Cancel" __title="Cancel"}</a>
</div>
</div>
</form>
</div>
{include file='MUTransport_admin_footer.tpl'}

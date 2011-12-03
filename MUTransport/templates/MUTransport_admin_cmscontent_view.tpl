{zdebug}{* purpose of this template: view template for admin area *}
{pnajaxheader modname='MUTransport' filename='MUTransport_admin_modifyconfig.js' effects=true nobehaviour=true noscriptaculous=true}
{include file="MUTransport_admin_header.tpl"}

{gt text='List of Content' assign='templatetitle'} 
{gt text='not transported' assign='nottransported'}

<div class="pn-admincontainer">
<div class="pn-adminpageicon">{pnimg modname="core" src="windowlist.gif" set="icons/large" alt=$templatetitle}</div>
<h2>{$templatetitle}</h2>
<form action="index.php?module=mutransport&type=admin&func=transport&kind=content"
	method="post" name="transport">

<table class="z-admintable">
	<thead>
		<tr>
			<th align="right" valign="middle"><input type="checkbox" id="MUTransport_all_boxes" name="mutransport_all_boxes" onClick="allboxes();"></th>
			<th align="right" valign="middle">{if $sort eq "cmsid"}
			<a href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='modulid' sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='modulid' sdir='asc'}">
			{/if} {gt text="CMS"} </a></th>
			<th align="right" valign="middle">{if $sort eq "cmscontentid"}
			<a href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='pageid' sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='pageid' sdir='asc'}">
			{/if} {gt text="Page Id in CMS"} </a></th>
			<th align="left" valign="middle">{if $sort eq "title"} <a
				href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='title' sdir=$sdir}'
			style="font-style: italic"> {else} <a href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='title' sdir='asc'}">
			{/if} {gt text="Title"} </a></th>
			<th align="left" valign="middle">{if $sort eq "text"} <a
				href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='text' sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='text' sdir='asc'}">
			{/if} {gt text="Content"} </a></th>
			<th align="right" valign="middle">{if $sort eq "number_characters"}
			<a href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='number_characters' sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='number_characters' sdir='asc'}">
			{/if} {gt text="Number of Characters"} </a></th>
			<th align="left" valign="middle">{if $sort eq "transport"}
			<a href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='transport' sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{modurl modname='MUTransport' type='admin' func='view' ot='cmscontent' sort='transport' sdir='asc'}">
			{/if} {gt text="Status of transport"} </a></th>
			<th align="left" valign="middle">{gt text="Options"}</th>
		</tr>
	</thead>
	<tbody>

		{foreach item='cmscontent' from=$objectArray}
		<tr valign="middle" class="
			{cycle values="z-odd, z-even"}
			">
			<td align="right" valign="top"><input type="checkbox" value="{$cmscontent.contentid}.{$cmscontent.cms_name}"
			name=yes[]></td>
			<td align="right" valign="top">{$cmscontent.cms_name|default:""}
			</td>
			<td align="right" valign="top">{$cmscontent.contentid|pnvarprepfordisplay|default:""}
			</td>
			<td align="left" valign="top">{$cmscontent.title|pnvarprepfordisplay|default:""}
			</td>
			<td align="left" valign="top">{$cmscontent.text|pnvarprepfordisplay|default:""}
			</td>
			<td align="right" valign="top">{$cmscontent.number_characters|pnvarprepfordisplay|default:""}
			</td>

			<td align="left" valign="top">{if $cmscontent.transport eq 0} {pnimg modname="core" src="redled.gif" set="icons/extrasmall" alt=$nottransported}
			{else} {img modname="core" src="greenled.gif" set="icons/extrasmall" alt=$nottransported}
			{$cmscontent.transport|pnvarprepfordisplay|default:""}{gt text=' Times'}
			{/if}</td>
			<td align="right" valign="top" style="white-space: nowrap">
			</td>
		</tr>
		{foreachelse}
		<tr class="
			{cycle values="z-odd, z-even"}
			">
			<td align="left" valign="top" colspan="8">{gt text='No Content'}
			</td>
		</tr>
		{/foreach}
<!--   		<tr>
			<td colspan="8"><label for="number" id="number">{gt text='Number of Copies'}</label><select
				name="number" size="1">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select><br />
			</td>
		</tr>  -->


	</tbody>
</table>

{if $statuspages eq 3} <input type="submit" value="{gt text='Transport'}">
{else} <input type="submit" value="{gt text="Transport"}"
disabled> {/if} <input type="reset" value="{gt text="Reset"}">
</form>
{pager rowcount=$pager.numitems limit=$pager.itemsperpage posvar=startnum shift=1 img_prev=images/icons/extrasmall/previous.gif img_next=images/icons/extrasmall/next.gif}
</div>
{include file='MUTransport_admin_footer.tpl'}
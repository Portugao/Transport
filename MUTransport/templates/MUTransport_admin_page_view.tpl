{* purpose of this template: view template for admin area *}
{ajaxheader modname='MUTransport' filename='MUTransport_admin_modifyconfig.js' effects=true nobehaviour=true noscriptaculous=true}
{include file="MUTransport_admin_header.tpl"}

{gt text='List of Pages' assign='templatetitle'} 
{gt text='not transported' assign='nottransported'}

<div class="pn-admincontainer">
<div class="pn-adminpageicon">{pnimg modname="core" src="windowlist.gif" set="icons/large" alt=$templatetitle}</div>

<h2>{$templatetitle}</h2>
<form action="index.php?module=mutransport&type=admin&func=transport"
	method="post" name="transport">

<table class="z-admintable">
	<thead>
		<tr>
			<th align="right" valign="middle"><input type="checkbox" id="MUTransport_all_boxes" name="mutransport_all_boxes" onClick="allboxes();"></th>
			<th align="right" valign="middle">{if $sort eq "modulid"}
			<a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="modulid" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="modulid" sdir="asc"}">
			{/if} {gt text="Modul"} </a></th>
			<th align="right" valign="middle">{if $sort eq "pageid"}
			<a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="pageid" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="pageid" sdir="asc"}">
			{/if} {gt text="Page Id in Modul"} </a></th>
			<th align="left" valign="middle">{if $sort eq "title"} <a
				href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="title" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="title" sdir="asc"}">
			{/if} {gt text="Title"} </a></th>
			<th align="left" valign="middle">{if $sort eq "text"} <a
				href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="text" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="text" sdir="asc"}">
			{/if} {gt text="Content"} </a></th>
			<th align="right" valign="middle">{if $sort eq "number_characters"}
			<a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="number_characters" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="number_characters" sdir="asc"}">
			{/if} {gt text="Number of Characters"} </a></th>
			<th align="left" valign="middle">{if $sort eq "transport"}
			<a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="transport" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="page" sort="transport" sdir="asc"}">
			{/if} {gt text="Status of transport"} </a></th>
			<th align="left" valign="middle">{gt text="Options"}</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$objectArray item="page"}
		<tr valign="middle" class="{cycle values="z-odd, z-even"}">
			<td align="right" valign="top"><input type="checkbox" value="{$page.pageid}.{$page.modul_name}"
			name=yes[] id=yes[]"></td>
			<td align="right" valign="top">{$page.modul_name|default:""}
			</td>
			<td align="right" valign="top">{$page.pageid|pnvarprepfordisplay|default:""}
			</td>
			<td align="left" valign="top">{$page.title|pnvarprepfordisplay|default:""}
			</td>
			<td align="left" valign="top">{$page.text|pnvarprepfordisplay|default:""}
			</td>
			<td align="right" valign="top">{$page.number_characters|pnvarprepfordisplay|default:""}
			</td>

			<td align="left" valign="top">{if $page.transport eq 0} {pnimg modname="core" src="redled.gif" set="icons/extrasmall" alt=$nottransported}
			{else} {pnimg modname="core" src="greenled.gif" set="icons/extrasmall" alt=$nottransported}
			{$page.transport|pnvarprepfordisplay|default:""}{gt text=' Times'}
			{/if}</td>
			<td align="right" valign="top" style="white-space: nowrap">&nbsp;
			</td>
		</tr>
		{foreachelse}
		<tr class="
			{cycle values="z-odd, z-even"}
			">
			<td align="left" valign="top" colspan="8">{gt text='No Pages'}
			</td>
		</tr>
		{/foreach}
		<tr>
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
		</tr>


	</tbody>
</table>

{if $statuscontent eq 3 || $statusnews eq 3 || $statuspages eq 3} <input type="submit" value="{gt text="Transport"}">
{else} <input type="submit" value="{gt text="Transport"}"
disabled> {/if} <input type="reset" value="{gt text="Reset"}"">
</form>
{pager rowcount=$pager.numitems limit=$pager.itemsperpage posvar=startnum shift=1 img_prev=images/icons/extrasmall/previous.gif img_next=images/icons/extrasmall/next.gif}
</div>
{include file="MUTransport_admin_footer.tpl"}
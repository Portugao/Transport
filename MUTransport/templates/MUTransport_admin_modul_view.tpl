{* purpose of this template: view template for admin area *}

{include file="MUTransport_admin_header.tpl"}

{gt text='List of Modules' assign='templatetitle'} {gt text='Get and update Pages of Modul' assign='editTitle'}
{gt text='Delete Pages of Modul' assign='deleteTitle'} {gt text='active' assign='active'}
{gt text='inactive' assign='inactive'} {gt text='not installed' assign='notinstalled'}
{gt text='not availabale' assign='notavailable'}

<div class="z-admincontainer">
<div class="z-adminpageicon">{pnimg modname="core" src="windowlist.gif" set="icons/large" alt=$templatetitle}</div>
<h2>{$templatetitle}</h2>

{securityutil_checkpermission_block component="MUTransport::" instance=".*" level="ACCESS_ADD"}
<p></p>
{/securityutil_checkpermission_block}

<table class="z-admintable">
	<thead>
		<tr>
			<th align="left" valign="middle">{if $sort eq "name"} <a
				href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="modul" sort="name" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="modul" sort="name" sdir="asc"}">
			{/if} {gt text="Name"} </a></th>
			<th align="left" valign="middle">{if $sort eq "state"} <a
				href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="modul" sort="state" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="modul" sort="state" sdir="asc"}">
			{/if} {gt text="Status"} </a></th>

			<th align="left" valign="middle">{gt text="Options"}</th>
		</tr>
	</thead>
	<tbody>

		{foreach from=$objectArray item="modul"}
		<tr class="
			{cycle values="z-odd, z-even"}
			">
			<td align="left" valign="top">{$modul.name|pnvarprephtmldisplay|default:""}

			</td>
			<td align="left" valign="top">{if $modul.state eq $active}
			{pnimg modname="core" src="greenled.gif" set="icons/extrasmall" alt=$active}
			{else} {pnimg modname="core" src="redled.gif" set="icons/extrasmall" alt=$notinstalled}
			{/if} {$modul.state|pnvarprepfordisplay|default:""}</td>



			<td align="right" valign="top" style="white-space: nowrap">{if $modul.state eq $active || $modul.state eq $inactive}
			{securityutil_checkpermission_block component="MUTransport::" instance=".*" level="ACCESS_EDIT"}
			<a href="{pnmodurl modname=MUTransport type=admin func=read id=$modul.modulid name=$modul.name}">
			{pnimg src="edit_add.gif" modname="core" set="icons/extrasmall" alt=_EDIT altml=true title=$editTitle}
			</a> {/securityutil_checkpermission_block} {securityutil_checkpermission_block component="MUTransport::" instance=".*" level="ACCESS_EDIT"}
			<a href="{pnmodurl modname=MUTransport type=admin func=pagedelete id=$modul.modulid name=$modul.name}">
			{pnimg src="edit_remove.gif" modname="core" set="icons/extrasmall" alt=_EDIT altml=true title=$deleteTitle}
			</a> {/securityutil_checkpermission_block}{/if}</td>


		</tr>
		{foreachelse}
		<tr class="{cycle values="z-odd, z-even"}">
			<td align="left" valign="top" colspan="4">{gt text="No Modules"}
			</td>
		</tr>
		{/foreach}

	</tbody>
</table>

{pager rowcount=$pager.numitems limit=$pager.itemsperpage}</div>

{include file="MUTransport_admin_footer.tpl"}
{* purpose of this template: view template for admin area *}
{pnajaxheader modname='MUTransport' filename='MUTransport_admin_modifyconfig.js' effects=true nobehaviour=true noscriptaculous=true}
{include file="MUTransport_admin_header.tpl"}

{gt text='List of User' assign='templatetitle'} {gt text='Get and update Pages of Modul' assign='editTitle'}
{gt text='Delete Pages of Modul' assign='deleteTitle'} {gt text='active' assign='active'}
{gt text='inactive' assign='inactive'} {gt text='not installed' assign='notinstalled'}
{gt text='not availabale' assign='notavailable'}

<div class="z-admincontainer">
<div class="z-adminpageicon">{pnimg modname="core" src="windowlist.gif" set="icons/large" alt=$templatetitle}</div>

<h2>{$templatetitle}</h2>

{securityutil_checkpermission_block component="MUTransport::" instance=".*" level="ACCESS_ADD"}
<p></p>
{/securityutil_checkpermission_block}

<form action="index.php?module=mutransport&type=admin&func=transport&kind=user"
	method="post" name="transport">

<table class="z-admintable">
	<thead>
		<tr>
			<th align="right" valign="middle"><input type="checkbox" id="MUTransport_all_boxes" name="mutransport_all_boxes" onClick="allboxes();"></th>
			<th align="left" valign="middle">{if $sort eq "name"} <a
				href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="user" sort="cmsid" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="user" sort="cmsid" sdir="asc"}">
			{/if} {gt text="CMS"}</a></th>
			<th align="left" valign="middle">{if $sort eq "userid"} <a
				href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="user" sort="userid" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="user" sort="userid" sdir="asc"}">
			{/if} {gt text="User ID in CMS"}</a></th>
			<th align="left" valign="middle">{if $sort eq "uname"} <a
				href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="user" sort="uname" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="user" sort="uname" sdir="asc"}">
			{/if} {gt text="Name of User"}</a></th>
			<th align="left" valign="middle">{if $sort eq "email"} <a
				href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="user" sort="email" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="user" sort="email" sdir="asc"}">
			{/if} {gt text="Email of User"}</a></th>
			<th align="left" valign="middle">{gt text="Options"}</th>
		</tr>
	</thead>
	<tbody>

		{foreach from=$objectArray item="user"}
		<tr class="{cycle values="z-odd, z-even"}">
		    <td align="right" valign="top"><input type="checkbox" value="{$user.userid}.{$user.user_name}"
			name=yes[]></td>
			<td align="left" valign="top">{$user.user_name|pnvarprephtmldisplay|default:""}
			</td>
			<td align="left" valign="top">{$user.userid|pnvarprephtmldisplay|default:""}
			</td>
			<td align="left" valign="top">{$user.uname|pnvarprephtmldisplay|default:""}
			</td>
			<td align="left" valign="top">{$user.email|pnvarprepfordisplay|default:""}</td>



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
		<tr class="
			{cycle values="z-odd, z-even"}
			">
			<td align="left" valign="top" colspan="6">{gt text="No Users"}
			</td>
		</tr>
		{/foreach}

	</tbody>
</table>
<input type="submit" value="{gt text="Transport"}">
<input type="reset" value="{gt text="Reset"}"">
</form>
{pager rowcount=$pager.numitems limit=$pager.itemsperpage}</div>

{include file="MUTransport_admin_footer.tpl"}
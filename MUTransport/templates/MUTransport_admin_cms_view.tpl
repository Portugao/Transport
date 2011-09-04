{* purpose of this template: view template for admin area  *}

{include file="MUTransport_admin_header.tpl"}

{gt text='List of CMS' assign='templatetitle'}
{gt text='Get Content of CMS' assign='editContent'}
{gt text='Delete Content of CMS' assign='deleteContent'}
{gt text='Get User of CMS' assign='editUser'}
{gt text='Delete User of CMS' assign='deleteUser'}
{gt text='active' assign='active'}
{gt text='inactive' assign='inactive'}
{gt text='not installed' assign='notinstalled'}
{gt text='not availabale' assign='notavailable'}
{gt text='connection made' assign='con_yes'}

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
				href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="cms" sort="name" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="cms" sort="name" sdir="asc"}">
			{/if} {gt text="Name"} </a></th>
			<th align="left" valign="middle">{if $sort eq "state"} <a
				href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="cms" sort="state" sdir=$sdir}"
			style="font-style: italic"> {else} <a href="{pnmodurl modname="MUTransport" type="admin" func="view" ot="cms" sort="state" sdir="asc"}">
			{/if} {gt text="Status"} </a></th>

			<th align="left" valign="middle">{gt text="Options"}</th>
		</tr>
	</thead>
	<tbody>

		{foreach from=$objectArray item="cms"}
		<tr class="
			{cycle values="z-odd, z-even"}
			">
			<td align="left" valign="top">{$cms.name|pnvarprephtmldisplay|default:""}

			</td>
			<td align="left" valign="top">{if $cms.state eq $con_yes}
			{pnimg modname="core" src="greenled.gif" set="icons/extrasmall" alt=$con_yes}
			{else} {pnimg modname="core" src="redled.gif" set="icons/extrasmall" alt=$notinstalled}
			{/if} {$cms.state|pnvarprepfordisplay|default:""}</td>

			<td align="right" valign="top" style="white-space: nowrap">{if $cms.state eq $con_yes}
			{securityutil_checkpermission_block component="MUTransport::" instance=".*" level="ACCESS_EDIT"}
			<a href="{pnmodurl modname=MUTransport type=admin func=read cmsid=$cms.cmsid name=$cms.name kind=content}">
			{pnimg src="edit_add.gif" modname="core" set="icons/extrasmall" alt=editContent altml=true title=$editContent}
			</a> {/securityutil_checkpermission_block}
			{securityutil_checkpermission_block component="MUTransport::" instance=".*" level="ACCESS_EDIT"}
			<a href="{pnmodurl modname=MUTransport type=admin func=pagedelete cmsid=$cms.cmsid name=$cms.name kind=content}">
			{pnimg src="edit_remove.gif" modname="core" set="icons/extrasmall" alt=$deleteContent altml=true title=$deleteContent}
			</a> {/securityutil_checkpermission_block}<br />
			{securityutil_checkpermission_block component="MUTransport::" instance=".*" level="ACCESS_EDIT"}
			<a href="{pnmodurl modname=MUTransport type=admin func=read cmsid=$cms.cmsid name=$cms.name kind=user}">
			{pnimg src="edit_add.gif" modname="core" set="icons/extrasmall" alt=$editUser altml=true title=$editUser}
			</a> {/securityutil_checkpermission_block}
			{securityutil_checkpermission_block component="MUTransport::" instance=".*" level="ACCESS_EDIT"}
			<a href="{pnmodurl modname=MUTransport type=admin func=pagedelete cmsid=$cms.cmsid name=$cms.name kind=user}">
			{pnimg src="edit_remove.gif" modname="core" set="icons/extrasmall" alt=$deleteUser altml=true title=$deleteUser}
			</a> {/securityutil_checkpermission_block}{/if}</td>

		</tr>
		{foreachelse}
		<tr class="
			{cycle values="z-odd, z-even"}
			">
			<td align="left" valign="top" colspan="4">{gt text="No CMS"}
			</td>
		</tr>
		{/foreach}

	</tbody>
</table>

{pager rowcount=$pager.numitems limit=$pager.itemsperpage}</div>

{include file="MUTransport_admin_footer.tpl"]-->
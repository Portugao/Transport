{* Purpose of this template: 3rd step of init process: thanks *}

<h2>{gt text="Last step"}</h2>
<p>{gt text="Finish the installation of modul ?"}</p>
<p>{gt text="Thank you for using MUTransport"}</p>
{* <p><a href="{pnmodurl modname="Modules" type="admin" func="initialise" authid=$authid activate=$activate}"
title="{gt text="Continue"}"> {gt text="Continue"}</a></p> *}
{insert name='csrftoken' assign='csrftoken'}
    <p><a href="{modurl modname='Modules' type='admin' func='initialise' authid=$authid csrftoken=$csrftoken activate=$activate}" title="{gt text='Complete the installation'}">
        {gt text='Continue'}
    </a></p>

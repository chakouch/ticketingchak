@extends('account.template')
@section('page-title', _i("Identifiants Clouds"))

@section('breadcrumbs')
    {{ Breadcrumbs::render("account.cloud_credentials") }}
@endsection

@section('account_content')
<div id="account_cloud_credentials" class="panel panel-default panel_with_buttons">
    <div class="panel-heading">
        <h4 class="panel-title"><img src="/imgs/creds_cloud.png" class="left-menu-icons-account" />{{ _i("Identifiants Clouds") }}</h4>
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs" role="tablist">
            @if($procci_aws_started)
            <li role="presentation" class="active"><a href="#creds_amazonaws" aria-controls="creds_amazonaws" role="tab" data-toggle="tab"><i class="amazonaws-50"></i> Amazon Web Services</a></li>
            @endif
            
            @if($procci_gcp_started)
            <li role="presentation"><a href="#creds_googlecloud" aria-controls="creds_googlecloud" role="tab" data-toggle="tab"><i class="googlegcp-50"></i> Google Cloud Platform</a></li>
            @endif

            @if($procci_az_started)
            <li role="presentation"><a href="#creds_microsoftazure" aria-controls="creds_microsoftazure" role="tab" data-toggle="tab"><i class="microsoftazure-50"></i> Microsoft Azure</a></li>
            @endif

            @if($procci_ovh_started)
            <li role="presentation"><a href="#creds_ovh" aria-controls="creds_ovh" role="tab" data-toggle="tab"><i class="ovh-50"></i>OVH</a></li>
            @endif

            @if($procci_cw_started)
            <li role="presentation"><a href="#creds_cloudwatt" aria-controls="creds_cloudwatt" role="tab" data-toggle="tab"><i class="cloudwatt-50"></i> CloudWatt</a></li>
            @endif
            
            @if($procci_fe_started)
            <li role="presentation"><a href="#creds_flexible_engine" aria-controls="creds_flexible_engine" role="tab" data-toggle="tab"><i class="flexibleengine-50"></i> Flexible Engine</a></li>
            @endif

            @if($procci_vc_started)
            <li role="presentation"><a href="#creds_vcloud" aria-controls="creds_vcloud" role="tab" data-toggle="tab"><i class="vcloud-50"></i> vCloud</a></li>
            @endif

            @if($procci_vs_started)
            <li role="presentation"><a href="#creds_vsphere" aria-controls="creds_vsphere" role="tab" data-toggle="tab"><i class="vsphere-50"></i> vSphere</a></li>
            @endif

            @if($procci_os_started)
            <li role="presentation"><a href="#creds_openstack" aria-controls="creds_openstack" role="tab" data-toggle="tab"><i class="openstack-50"></i> OpenStack</a></li>
            @endif

        </ul>


        <div class="tab-content">
            @if($procci_aws_started)
            <div role="tabpanel" class="tab-pane active" id="creds_amazonaws">
                <br />
                <div class="panel_with_buttons panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">
                            <a href="{{ config("uic.cloud_urls.aws") }}" target="_blank" class="cloud_url">
                                Amazon Web Services
                            </a>
                        </h4>
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_create_aws_credentials">{{ _i("Ajouter un identifiant") }}</button>
                    </div>
                    <div class="panel-body">
                        <table id="table_creds_amazonaws" class="table table-striped table-bordered table-condensed display dt-responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th data-priority="0">{{ _i("Nom") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Clé d'accès") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Région par défaut") }}</th>
                                    <th class="actions" data-priority="0">{{ _i("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($amazonaws ?? [] as $aws_config)
                                <tr>
                                    <td></td>
                                    <td>{{ $aws_config->tenant }}</td>
                                    <td>{{ $aws_config->accesskey }}</td>
                                    <td>{{ $aws_config->getDefaultRegion() }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ _i("Actions") }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal" data-target="#modal_cloud_credentials_aws_configuration"
                                                       data-action="open_config"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant Amazon Web Services « %s »", $aws_config->tenant)}}"
                                                       data-cloud="{{ Provider::AMAZON }}" data-tenant_id="{{ $aws_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.amazon.configuration', $aws_config->id) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configuration") }}</a>
                                                </li>
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_cloud_credentials_proxy_config"
                                                       data-modal_title="{{ _i("Configuration du Proxy") . sprintf(" (%s, %s)", "Amazon Web Services", $aws_config->tenant) }}"
                                                       data-url="{{ route('account.cloud_credentials.proxy_config', [Provider::AMAZON, $aws_config->id]) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configurer le Proxy") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_aws_credentials"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant Amazon Web Services « %s »", $aws_config->tenant)}}"
                                                       data-cloud="{{ Provider::AMAZON }}" data-tenant_id="{{ $aws_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.amazon.update', $aws_config->id) }}"
                                                       data-access_key="{{ $aws_config->accesskey }}"
                                                       data-default_region="{{ $aws_config->extra["default_region"] ?? null }}"
                                                       data-proxy="{{ $aws_config->http_proxy }}"
                                                    ><span class="glyphicon glyphicon-briefcase"></span> {{ _i("Modifier les identifiants") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_delete_cloud_credentials"
                                                       data-action_url="{{ route('account.cloud_credentials.delete', [Provider::AMAZON, $aws_config->id]) }}"
                                                       data-confirm_msg="{{ _i("Voulez-vous vraiment supprimer cet identifiant de Cloud ? (%s, %s)", 'Amazon Web Services', $aws_config->tenant) }}"
                                                    ><span class="glyphicon glyphicon-trash"></span> {{ _i("Supprimer") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            
            
            @if($procci_gcp_started)
            <div role="tabpanel" class="tab-pane" id="creds_googlecloud">
                <br />
                <div class="panel_with_buttons panel panel-default">
                    <div class="panel-heading clearfix">
                         <h4 class="panel-title pull-left">
                            <a href="{{ config("uic.cloud_urls.google") }}" target="_blank" class="cloud_url">
                                Google Cloud Platform
                            </a>
                        </h4>
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_create_google_credentials">{{ _i("Ajouter un identifiant") }}</button>
                    </div>
                    <div class="panel-body">
                        <table id="table_creds_google" class="table table-striped table-bordered table-condensed display dt-responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th data-priority="0">{{ _i("Nom") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("ID de projet") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("ID de client") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Email client") }}</th>
                                    <th class="toggle" data-priority="3">{{ _i("URL d'authentification certificat") }}</th>
                                    <th class="toggle" data-priority="2">{{ _i("URL client") }}</th>
                                    <th class="toggle" data-priority="3">{{ _i("Type") }}</th>
                                    <th class="toggle" data-priority="3">{{ _i("URI d'authentification") }}</th>
                                    <th class="toggle" data-priority="3">{{ _i("URI de jeton") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Région par défaut") }}</th>
                                    <th class="actions" data-priority="0">{{ _i("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($googlecloud ?? [] as $gcp_config)
                                <tr>
                                    <td></td>
                                    <td>{{ $gcp_config->tenant }}</td>
                                    <td>{{ $gcp_config->project_id }}</td>
                                    <td>{{ $gcp_config->client_id }}</td>
                                    <td>{{ $gcp_config->client_email }}</td>
                                    <td>{{ $gcp_config->auth_provider_x509_cert_url }}</td>
                                    <td>{{ $gcp_config->client_x509_cert_url }}</td>
                                    <td>{{ $gcp_config->type }}</td>
                                    <td>{{ $gcp_config->auth_uri }}</td>
                                    <td>{{ $gcp_config->token_uri }}</td>
                                    <td>{{ $gcp_config->getDefaultRegion() }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ _i("Actions") }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal" data-target="#modal_cloud_credentials_google_configuration"
                                                       data-action="open_config"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant Google Cloud Platform « %s »", $gcp_config->tenant)}}"
                                                       data-cloud="{{ Provider::GOOGLE }}" data-tenant_id="{{ $gcp_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.google.configuration', $gcp_config->id) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configuration") }}</a>
                                                </li>
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_cloud_credentials_proxy_config"
                                                       data-modal_title="{{ _i("Configuration du Proxy") . sprintf(" (%s, %s)", "Google Cloud Platform", $gcp_config->tenant) }}"
                                                       data-url="{{ route('account.cloud_credentials.proxy_config', [Provider::GOOGLE, $gcp_config->id]) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configurer le Proxy") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_google_credentials"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant Google Cloud Platform « %s »", $gcp_config->tenant)}}"
                                                       data-cloud="{{ Provider::GOOGLE }}" data-tenant_id="{{ $gcp_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.google.update', $gcp_config->id) }}"
                                                       data-proxy="{{ $gcp_config->http_proxy }}"
                                                    ><span class="glyphicon glyphicon-briefcase"></span> {{ _i("Modifier les identifiants") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_delete_cloud_credentials"
                                                       data-action_url="{{ route('account.cloud_credentials.delete', [Provider::GOOGLE, $gcp_config->id]) }}"
                                                       data-confirm_msg="{{ _i("Voulez-vous vraiment supprimer cet identifiant de Cloud ? (%s, %s)", 'Google Cloud Platform', $gcp_config->tenant) }}"
                                                    ><span class="glyphicon glyphicon-trash"></span> {{ _i("Supprimer") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            @if($procci_az_started)
            <div role="tabpanel" class="tab-pane" id="creds_microsoftazure">
                <br/>
                <div class="panel_with_buttons panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">
                            <a href="{{ config("uic.cloud_urls.azure") }}" target="_blank" class="cloud_url">
                                Microsoft Azure
                            </a>
                        </h4>
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_create_azure_credentials">{{ _i("Ajouter un identifiant") }}</button>
                    </div>
                    <div class="panel-body">
                        <table id="table_creds_microsoftazure" class="table table-striped table-bordered table-condensed display dt-responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th data-priority="0">{{ _i("Nom") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("ID de souscription") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("ID client") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("ID de tenant") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Région par défaut") }}</th>
                                    <th class="actions" data-priority="0">{{ _i("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($microsoftazure ?? [] as $azure_config)
                                <tr>
                                    <td></td>
                                    <td>{{ $azure_config->tenant }}</td>
                                    <td>{{ $azure_config->subscription }}</td>
                                    <td>{{ $azure_config->clientid }}</td>
                                    <td>{{ $azure_config->tenantid }}</td>
                                    <td>{{ $azure_config->getDefaultRegion() }}</td>
                                   <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ _i("Actions") }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal" data-target="#modal_cloud_credentials_azure_configuration"
                                                       data-action="open_config"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant Microsoft Azure « %s »", $azure_config->tenant)}}"
                                                       data-cloud="{{ Provider::AZURE }}" data-tenant_id="{{ $azure_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.azure.configuration', $azure_config->id) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configuration") }}</a>
                                                </li>
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_cloud_credentials_proxy_config"
                                                       data-modal_title="{{ _i("Configuration du Proxy") . sprintf(" (%s, %s)", "Microsoft Azure", $azure_config->tenant) }}"
                                                       data-url="{{ route('account.cloud_credentials.proxy_config', [Provider::AZURE, $azure_config->id]) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configurer le Proxy") }}</a>
                                                </li>
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_azure_credentials"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant Microsoft Azure « %s »", $azure_config->tenant)}}"
                                                       data-cloud="{{ Provider::AZURE }}" data-tenant_id="{{ $azure_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.azure.update', $azure_config->id) }}"
                                                       data-subscription="{{ $azure_config->subscription }}"
                                                       data-clientid="{{ $azure_config->clientid }}"
                                                       data-tenantid="{{ $azure_config->tenantid }}"
                                                       data-proxy="{{ $azure_config->http_proxy }}"
                                                    ><span class="glyphicon glyphicon-briefcase"></span> {{ _i("Modifier les identifiants") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_delete_cloud_credentials"
                                                       data-action_url="{{ route('account.cloud_credentials.delete', [Provider::AZURE, $azure_config->id]) }}"
                                                       data-confirm_msg="{{ _i("Voulez-vous vraiment supprimer cet identifiant de Cloud ? (%s, %s)", 'Microsoft Azure', $azure_config->tenant) }}"
                                                    ><span class="glyphicon glyphicon-trash"></span> {{ _i("Supprimer") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            @if($procci_ovh_started)
             <div role="tabpanel" class="tab-pane" id="creds_ovh">
                <br/>
                <div class="panel_with_buttons panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">
                            <a href="https://www.ovh.com/fr/cloud/" target="_blank" class="cloud_url">
                                OVH
                            </a>
                        </h4>
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_create_ovh_credentials">{{ _i("Ajouter un identifiant") }}</button>
                    </div>
                    <div class="panel-body">
                        <table id="table_creds_ovh" class="table table-striped table-bordered table-condensed display dt-responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th data-priority="0">{{ _i("Nom") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Clé d'application") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Nombre de projets") }}</th>
                                    <th class="actions" data-priority="0">{{ _i("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ovh ?? [] as $ovh_config)
                                    <tr>
                                        <td></td>
                                        <td>{{ $ovh_config->tenant }}</td>
                                        <td>{{ $ovh_config->appkey }}</td>
                                        <td>{{ count($ovh_config->getSavedProjects()) }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ _i("Actions") }} <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#modal_ovh_projects" data-action="open_project" data-tenant_id="{{ $ovh_config->id }}" 
                                                            data-url_add_project="{{ route('account.cloud_credentials.ovh.add_project', $ovh_config->id)}}" 
                                                            data-url_projects="{{ route('account.cloud_credentials.ovh.projects', $ovh_config->id) }}">
                                                            <span class="glyphicon glyphicon-th-list"></span> {{ _i("Projets") }}
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#modal_cloud_credentials_ovh_configuration" data-action="open_config" 
                                                            data-modal_title="{{ _i("Configuration de l'identifiant OVH « %s »", $ovh_config->tenant)}}" data-cloud="{{ Provider::OVH }}" 
                                                            data-tenant_id="{{ $ovh_config->id }}" data-url="{{ route('account.cloud_credentials.ovh.configuration', $ovh_config->id) }}">
                                                            <span class="glyphicon glyphicon-cog"></span> {{ _i("Configuration") }}
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#modal_edit_cloud_credentials_proxy_config"
                                                            data-modal_title="{{ _i("Configuration du Proxy") . sprintf(" (%s, %s)", "OVH", $ovh_config->tenant) }}" 
                                                            data-url="{{ route('account.cloud_credentials.proxy_config', [Provider::OVH, $ovh_config->id]) }}">
                                                            <span class="glyphicon glyphicon-cog"></span> {{ _i("Configurer le Proxy") }}
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#modal_edit_ovh_credentials" 
                                                            data-modal_title="{{ _i("Configuration de l'identifiant OVH « %s »", $ovh_config->tenant)}}" 
                                                            data-cloud="{{ Provider::OVH }}" data-tenant_id="{{ $ovh_config->id }}" 
                                                            data-url="{{ route('account.cloud_credentials.ovh.update', $ovh_config->id) }}" 
                                                            data-host="{{ $ovh_config->host }}" 
                                                            data-endpoint="{{ $ovh_config->endpoint }}" 
                                                            data-appkey="{{ $ovh_config->appkey }}">
                                                            <span class="glyphicon glyphicon-briefcase"></span> {{ _i("Modifier les identifiants") }}
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#modal_delete_cloud_credentials"
                                                            data-action_url="{{ route('account.cloud_credentials.delete', [Provider::OVH, $ovh_config->id]) }}"
                                                            data-confirm_msg="{{ _i("Voulez-vous vraiment supprimer cet identifiant de Cloud ? (%s, %s)", 'OVH', $ovh_config->tenant) }}">
                                                            <span class="glyphicon glyphicon-trash"></span> {{ _i("Supprimer") }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            @if($procci_cw_started)
            <div role="tabpanel" class="tab-pane" id="creds_cloudwatt">
                <br/>
                <div class="panel_with_buttons panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">
                            <a href="{{ config("uic.cloud_urls.cloudwatt") }}" target="_blank" class="cloud_url">
                                CloudWatt
                            </a>
                        </h4>
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_create_cloudwatt_credentials">{{ _i("Ajouter un identifiant") }}</button>
                    </div>
                    <div class="panel-body">
                        <table id="table_creds_cloudwatt" class="table table-striped table-bordered table-condensed display dt-responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th data-priority="0">{{ _i("Nom") }}</th>
                                    <th class="toggle" data-priority="2">{{ _i("Hôte") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Utilisateur") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Projet") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Région par défaut") }}</th>
                                    <th class="actions" data-priority="0">{{ _i("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cloudwatt ?? [] as $cloudwatt_config)
                                <tr>
                                    <td></td>
                                    <td>{{ $cloudwatt_config->tenant }}</td>
                                    <td>{{ $cloudwatt_config->host }}</td>
                                    <td>{{ $cloudwatt_config->user }}</td>
                                    <td>{{ $cloudwatt_config->ostenant }}</td>
                                    <td>{{ $cloudwatt_config->getDefaultRegion() }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ _i("Actions") }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal" data-target="#modal_cloud_credentials_cloudwatt_configuration"
                                                       data-action="open_config"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant CloudWatt « %s »", $cloudwatt_config->tenant)}}"
                                                       data-cloud="{{ Provider::CLOUDWATT }}" data-tenant_id="{{ $cloudwatt_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.cloudwatt.configuration', $cloudwatt_config->id) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configuration") }}</a>
                                                </li>
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_cloud_credentials_proxy_config"
                                                       data-modal_title="{{ _i("Configuration du Proxy") . sprintf(" (%s, %s)", "CloudWatt", $cloudwatt_config->tenant) }}"
                                                       data-url="{{ route('account.cloud_credentials.proxy_config', [Provider::CLOUDWATT, $cloudwatt_config->id]) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configurer le Proxy") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_cloudwatt_credentials"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant CloudWatt « %s »", $cloudwatt_config->tenant)}}"
                                                       data-cloud="{{ Provider::CLOUDWATT }}" data-tenant_id="{{ $cloudwatt_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.cloudwatt.update', $cloudwatt_config->id) }}"
                                                       data-host="{{ $cloudwatt_config->host }}"
                                                       data-user="{{ $cloudwatt_config->user }}"
                                                       data-tenant="{{ $cloudwatt_config->ostenant }}"
                                                       data-proxy="{{ $cloudwatt_config->http_proxy }}"
                                                    ><span class="glyphicon glyphicon-briefcase"></span> {{ _i("Modifier les identifiants") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_delete_cloud_credentials"
                                                       data-action_url="{{ route('account.cloud_credentials.delete', [Provider::CLOUDWATT, $cloudwatt_config->id]) }}"
                                                       data-confirm_msg="{{ _i("Voulez-vous vraiment supprimer cet identifiant de Cloud ? (%s, %s)", 'CloudWatt', $cloudwatt_config->tenant) }}"
                                                    ><span class="glyphicon glyphicon-trash"></span> {{ _i("Supprimer") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            
            @if($procci_fe_started)
            <div role="tabpanel" class="tab-pane" id="creds_flexible_engine">
                <br/>
                
                <div class="panel_with_buttons panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">
                            <a href="{{ config("uic.cloud_urls.flexible_engine") }}" target="_blank" class="cloud_url">
                                Flexible Engine
                            </a>
                        </h4>
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_create_flexible_engine_credentials">{{ _i("Ajouter un identifiant") }}</button>
                    </div>
                    <div class="panel-body">
                        <table id="table_creds_flexible_engine" class="table table-striped table-bordered table-condensed display dt-responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th data-priority="0">{{ _i("Nom") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Compte entreprise") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Utilisateur") }}</th>
                                    <th class="toggle" data-priority="2">{{ _i("Régions") }}</th>
                                    <th class="toggle" data-priority="2">{{ _i("Version") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Région par défaut") }}</th>
                                    <th class="actions" data-priority="0">{{ _i("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($flexibleengine ?? [] as $fe_config)
                                <tr>
                                    <td></td>
                                    <td>{{ $fe_config->tenant }}</td>
                                    <td>{{ $fe_config->domain_id }}</td>
                                    <td>{{ $fe_config->user }}</td>
                                    <td>
                                        @foreach($fe_config->ptenants as $region)
                                            - {{ $region["name"] }} ({{ $region["id"] }}) <br/>
                                        @endforeach
                                    </td>
                                    <td>{{ $fe_config->version }}</td>
                                    <td>{{ $fe_config->getDefaultRegion() }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ _i("Actions") }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal" data-target="#modal_cloud_credentials_flexible_engine_configuration"
                                                       data-action="open_config"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant Flexible Engine « %s »", $fe_config->tenant)}}"
                                                       data-cloud="{{ Provider::FLEXIBLE_ENGINE }}" data-tenant_id="{{ $fe_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.flexible_engine.configuration', $fe_config->id) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configuration") }}</a>
                                                </li>
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_cloud_credentials_proxy_config"
                                                       data-modal_title="{{ _i("Configuration du Proxy") . sprintf(" (%s, %s)", "Flexible Engine", $fe_config->tenant) }}"
                                                       data-url="{{ route('account.cloud_credentials.proxy_config', [Provider::FLEXIBLE_ENGINE, $fe_config->id]) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configurer le Proxy") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_flexible_engine_credentials"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant Flexible Engine « %s »", $fe_config->tenant)}}"
                                                       data-cloud="{{ Provider::FLEXIBLE_ENGINE }}" data-tenant_id="{{ $fe_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.flexible_engine.update', $fe_config->id) }}"
                                                       data-domain_id="{{ $fe_config->domain_id }}"
                                                       data-user="{{ $fe_config->user }}"
                                                       data-regions="{{ json_encode($fe_config->ptenants) }}"
                                                       data-proxy="{{ $fe_config->http_proxy }}"
                                                    ><span class="glyphicon glyphicon-briefcase"></span> {{ _i("Modifier les identifiants") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_delete_cloud_credentials"
                                                       data-action_url="{{ route('account.cloud_credentials.delete', [Provider::FLEXIBLE_ENGINE, $fe_config->id]) }}"
                                                       data-confirm_msg="{{ _i("Voulez-vous vraiment supprimer cet identifiant de Cloud ? (%s, %s)", 'Flexible Engine', $fe_config->tenant) }}"
                                                    ><span class="glyphicon glyphicon-trash"></span> {{ _i("Supprimer") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            @if($procci_vc_started)
            <div role="tabpanel" class="tab-pane" id="creds_vcloud">
                <br/>
                <div class="panel_with_buttons panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">vCloud</h4>
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_create_vcloud_credentials">{{ _i("Ajouter un identifiant") }}</button>
                    </div>
                    <div class="panel-body">
                        <table id="table_creds_vcloud" class="table table-striped table-bordered table-condensed display dt-responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th data-priority="0">{{ _i("Nom") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Hôte") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Utilisateur") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Organisation") }}</th>
                                    <th class="toggle" data-priority="2">{{ _i("Version de l'API") }}</th>
                                    <th class="actions" data-priority="0">{{ _i("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vcloud ?? [] as $vcloud_config)
                                <tr>
                                    <td></td>
                                    <td>{{ $vcloud_config->tenant }}</td>
                                    <td>{{ $vcloud_config->host }}</td>
                                    <td>{{ $vcloud_config->user }}</td>
                                    <td>{{ $vcloud_config->organization }}</td>
                                    <td>{{ $vcloud_config->version }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ _i("Actions") }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal" data-target="#modal_cloud_credentials_vcloud_configuration"
                                                       data-action="open_config"
                                                       data-modal_title="{{ _i("Configuration du vCloud « %s »", $vcloud_config->tenant)}}"
                                                       data-cloud="{{ Provider::VCLOUD }}" data-tenant_id="{{ $vcloud_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.vcloud.configuration', $vcloud_config->id) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configuration") }}</a>
                                                </li>
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_cloud_credentials_proxy_config"
                                                       data-modal_title="{{ _i("Configuration du Proxy") . sprintf(" (%s, %s)", "vCloud", $vcloud_config->tenant) }}"
                                                       data-url="{{ route('account.cloud_credentials.proxy_config', [Provider::VCLOUD, $vcloud_config->id]) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configurer le Proxy") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_vcloud_credentials"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant vCloud « %s »", $vcloud_config->tenant)}}"
                                                       data-cloud="{{ Provider::VCLOUD }}" data-tenant_id="{{ $vcloud_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.vcloud.update', $vcloud_config->id) }}"
                                                       data-host="{{ $vcloud_config->host }}"
                                                       data-user="{{ $vcloud_config->user }}"
                                                       data-organization="{{ $vcloud_config->organization }}"
                                                       data-version="{{ $vcloud_config->version }}"
                                                       data-proxy="{{ $vcloud_config->http_proxy }}"
                                                       data-visible_ip="{{ $vcloud_config->extra["visible_ip_from_provider"] ?? null }}"
                                                    ><span class="glyphicon glyphicon-briefcase"></span> {{ _i("Modifier les identifiants") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_delete_cloud_credentials"
                                                       data-action_url="{{ route('account.cloud_credentials.delete', [Provider::VCLOUD, $vcloud_config->id]) }}"
                                                       data-confirm_msg="{{ _i("Voulez-vous vraiment supprimer cet identifiant de Cloud ? (%s, %s)", 'vCloud', $vcloud_config->tenant) }}"
                                                    ><span class="glyphicon glyphicon-trash"></span> {{ _i("Supprimer") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            @if($procci_vs_started)
            <div role="tabpanel" class="tab-pane" id="creds_vsphere">
                <br/>
                <div class="panel_with_buttons panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">vSphere</h4>
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_create_vsphere_credentials">{{ _i("Ajouter un identifiant") }}</button>
                    </div>
                    <div class="panel-body">
                        <table id="table_creds_vsphere" class="table table-striped table-bordered table-condensed display dt-responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th data-priority="0">{{ _i("Nom") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Serveur vCenter") }}</th>
                                    <th class="toggle" data-priority="2">{{ _i("Protocole") }}</th>
                                    <th class="toggle" data-priority="2">{{ _i("Port") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Utilisateur") }}</th>
                                    <th class="actions" data-priority="0">{{ _i("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vsphere ?? [] as $vsphere_config)
                                <tr>
                                    <td></td>
                                    <td>{{ $vsphere_config->tenant }}</td>
                                    <td>{{ $vsphere_config->host }}</td>
                                    <td>{{ $vsphere_config->protocol }}</td>
                                    <td>{{ $vsphere_config->port }}</td>
                                    <td>{{ $vsphere_config->user }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ _i("Actions") }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal" data-target="#modal_cloud_credentials_vsphere_configuration"
                                                       data-action="open_config"
                                                       data-modal_title="{{ _i("Configuration du vSphere « %s »", $vsphere_config->tenant)}}"
                                                       data-cloud="{{ Provider::VSPHERE }}" data-tenant_id="{{ $vsphere_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.vsphere.configuration', $vsphere_config->id) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configuration") }}</a>
                                                </li>
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_cloud_credentials_proxy_config"
                                                       data-modal_title="{{ _i("Configuration du Proxy") . sprintf(" (%s, %s)", "vSphere", $vsphere_config->tenant) }}"
                                                       data-url="{{ route('account.cloud_credentials.proxy_config', [Provider::VSPHERE, $vsphere_config->id]) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configurer le Proxy") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_vsphere_credentials"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant vSphere « %s »", $vsphere_config->tenant)}}"
                                                       data-cloud="{{ Provider::VCLOUD }}" data-tenant_id="{{ $vsphere_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.vsphere.update', $vsphere_config->id) }}"
                                                       data-host="{{ $vsphere_config->host }}"
                                                       data-protocol="{{ $vsphere_config->protocol }}"
                                                       data-port="{{ $vsphere_config->port }}"
                                                       data-user="{{ $vsphere_config->user }}"
                                                       data-proxy="{{ $vsphere_config->http_proxy }}"
                                                    ><span class="glyphicon glyphicon-briefcase"></span> {{ _i("Modifier les identifiants") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_delete_cloud_credentials"
                                                       data-action_url="{{ route('account.cloud_credentials.delete', [Provider::VSPHERE, $vsphere_config->id]) }}"
                                                       data-confirm_msg="{{ _i("Voulez-vous vraiment supprimer cet identifiant de Cloud ? (%s, %s)", 'vShere', $vsphere_config->tenant) }}"
                                                    ><span class="glyphicon glyphicon-trash"></span> {{ _i("Supprimer") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            @if($procci_os_started)
            <div role="tabpanel" class="tab-pane" id="creds_openstack">
                <br/>
                <div class="panel_with_buttons panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">OpenStack</h4>
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_create_openstack_credentials">{{ _i("Ajouter un identifiant") }}</button>
                    </div>
                    <div class="panel-body">
                        <table id="table_creds_openstack" class="table table-striped table-bordered table-condensed display dt-responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th data-priority="0">{{ _i("Nom") }}</th>
                                    <th class="toggle" data-priority="1">{{ _i("Hôte") }}</th>
                                    <th class="toggle" data-priority="2">{{ _i("Utilisateur") }}</th>
                                    <th class="toggle" data-priority="2">{{ _i("Projet") }}</th>
                                    <th class="actions" data-priority="0">{{ _i("Actions") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($openstack ?? [] as $openstack_config)
                                <tr>
                                    <td></td>
                                    <td>{{ $openstack_config->tenant }}</td>
                                    <td>{{ $openstack_config->host }}</td>
                                    <td>{{ $openstack_config->user }}</td>
                                    <td>{{ $openstack_config->ostenant }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ _i("Actions") }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal" data-target="#modal_cloud_credentials_openstack_configuration"
                                                       data-action="open_config"
                                                       data-modal_title="{{ _i("Configuration de l'OpenStack « %s »", $openstack_config->tenant)}}"
                                                       data-cloud="{{ Provider::OPENSTACK }}" data-tenant_id="{{ $openstack_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.openstack.configuration', $openstack_config->id) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configuration") }}</a>
                                                </li>
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_cloud_credentials_proxy_config"
                                                       data-modal_title="{{ _i("Configuration du Proxy") . sprintf(" (%s, %s)", "OpenStack", $openstack_config->tenant) }}"
                                                       data-url="{{ route('account.cloud_credentials.proxy_config', [Provider::OPENSTACK, $openstack_config->id]) }}"
                                                    ><span class="glyphicon glyphicon-cog"></span> {{ _i("Configurer le Proxy") }}</a>
                                                </li>
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal_edit_openstack_credentials"
                                                       data-modal_title="{{ _i("Configuration de l'identifiant OpenStack « %s »", $openstack_config->tenant)}}"
                                                       data-cloud="{{ Provider::OPENSTACK }}" data-tenant_id="{{ $openstack_config->id }}"
                                                       data-url="{{ route('account.cloud_credentials.openstack.update', $openstack_config->id) }}"
                                                       data-host="{{ $openstack_config->host }}"
                                                       data-user="{{ $openstack_config->user }}"
                                                       data-tenant="{{ $openstack_config->ostenant }}"
                                                       data-region="{{ $openstack_config->extra["region"] ?? null }}"
                                                       data-proxy="{{ $openstack_config->http_proxy }}"
                                                       data-visible_ip="{{ $openstack_config->extra["visible_ip_from_provider"] ?? null }}"
                                                    ><span class="glyphicon glyphicon-briefcase"></span> {{ _i("Modifier les identifiants") }}</a>
                                                </li>

                                                <li><a href="#" data-toggle="modal" data-target="#modal_delete_cloud_credentials"
                                                       data-action_url="{{ route('account.cloud_credentials.delete', [Provider::OPENSTACK, $openstack_config->id]) }}"
                                                       data-confirm_msg="{{ _i("Voulez-vous vraiment supprimer cet identifiant de Cloud ? (%s, %s)", 'OpenStack', $openstack_config->tenant) }}"
                                                    ><span class="glyphicon glyphicon-trash"></span> {{ _i("Supprimer") }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

{{-- vCloud --}}
@if($procci_vc_started)
    @include('account.cloud_credentials.vcloud.modal_create_credentials')
    @include('account.cloud_credentials.vcloud.modal_edit_credentials')
    @include('account.cloud_credentials.vcloud.modal_configuration')
@endif

{{-- vSphere --}}
@if($procci_vs_started)
    @include('account.cloud_credentials.vsphere.modal_create_credentials')
    @include('account.cloud_credentials.vsphere.modal_edit_credentials')
    @include('account.cloud_credentials.vsphere.modal_configuration')
@endif

{{-- Amazon Web Services --}}
@if($procci_aws_started)
    @include('account.cloud_credentials.amazon.modal_create_credentials')
    @include('account.cloud_credentials.amazon.modal_edit_credentials')
    @include('account.cloud_credentials.amazon.modal_configuration')
@endif

{{-- Google Cloud Platform --}}
@if($procci_gcp_started)
    @include('account.cloud_credentials.google.modal_create_credentials')
    @include('account.cloud_credentials.google.modal_edit_credentials')
    @include('account.cloud_credentials.google.modal_configuration')
@endif

{{-- Microsoft Azure --}}
@if($procci_az_started)
    @include('account.cloud_credentials.azure.modal_create_credentials')
    @include('account.cloud_credentials.azure.modal_edit_credentials')
    @include('account.cloud_credentials.azure.modal_configuration')
@endif

{{-- Flexible Engine --}}
@if($procci_fe_started)
    @include('account.cloud_credentials.flexible_engine.modal_create_credentials')
    @include('account.cloud_credentials.flexible_engine.modal_edit_credentials')
    @include('account.cloud_credentials.flexible_engine.modal_configuration')
    @include('account.cloud_credentials.flexible_engine.template_credentials_region')
@endif

{{-- CloudWatt --}}
@if($procci_cw_started)
    @include('account.cloud_credentials.cloudwatt.modal_create_credentials')
    @include('account.cloud_credentials.cloudwatt.modal_edit_credentials')
    @include('account.cloud_credentials.cloudwatt.modal_configuration')
@endif

{{-- OpenStack --}}
@if($procci_os_started)
    @include('account.cloud_credentials.openstack.modal_create_credentials')
    @include('account.cloud_credentials.openstack.modal_edit_credentials')
    @include('account.cloud_credentials.openstack.modal_configuration')
@endif

{{-- OVH --}}
@if($procci_ovh_started)
    @include('account.cloud_credentials.ovh.modal_create_credentials')
    @include('account.cloud_credentials.ovh.modal_configuration')
    @include('account.cloud_credentials.ovh.modal_edit_credentials')
    @include('account.cloud_credentials.ovh.projects.modal_ovh_projects')
    @include('account.cloud_credentials.ovh.projects.modal_ovh_add_project')
    @include('account.cloud_credentials.ovh.projects.modal_ovh_remove_project')
    @include('account.cloud_credentials.ovh.projects.modal_configuration_default_region')
@endif

{{-- Modale suppression creds --}}
<div id="modal_delete_cloud_credentials" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(array('method' => 'delete')) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ _i("Supprimer l'identifiant Cloud") }}</span></h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ _i("Annuler") }}</button>
                {!! Form::submit(_i("Supprimer l'identifiant Cloud"), ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{{-- Modal edit proxy config --}}
<div id="modal_edit_cloud_credentials_proxy_config" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ _i("Configuration du proxy") }}</h4>
            </div>

            <div class="modal-body">
                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ _i("Annuler") }}</button>
                {!! Form::button(_i("Sauvegarder"), ['type' => 'submit', 'class' => 'btn btn-primary btn-sm', 'form' => 'form_edit_cloud_credentials_proxy_config']) !!}
            </div>
        </div>
    </div>
</div>
@endsection
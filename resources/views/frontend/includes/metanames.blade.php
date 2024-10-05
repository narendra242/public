@if(Route::is('index'))
<title>{{ GeneralHelper::Generals()->title_tag?GeneralHelper::Generals()->title_tag:'' }}</title>
<meta name="keywords" content="{{ GeneralHelper::Generals()->meta_keyword?GeneralHelper::Generals()->meta_keyword:'' }}" />
<meta name="description" content="{{ GeneralHelper::Generals()->meta_description?GeneralHelper::Generals()->meta_description:'' }}">
@endif 
@if(!empty($contants))
<title>{{ $contants->title_tag?$contants->title_tag:'' }}</title>
<meta name="keywords" content="{{ $contants->meta_keyword?$contants->meta_keyword:'' }}" />
<meta name="description" content="{{ $contants->meta_description?$contants->meta_description:'' }}">
@endif
@if(!empty($info))
<title>{{ $info->title_tag?$info->title_tag:'' }}</title>
<meta name="keywords" content="{{ $info->meta_keyword?$info->meta_keyword:'' }}" />
<meta name="description" content="{{ $info->meta_description?$info->meta_description:'' }}">
@endif
@if(empty($error))
<link rel="canonical" href="{{url()->current()}}" />
<meta name="robots" content="all,follow">
@endif

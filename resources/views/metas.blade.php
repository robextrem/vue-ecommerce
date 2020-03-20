<?php
if (isset($metas)) {
    if (count($metas) > 0) {
        foreach ($metas as $type => $meta) {
            foreach ($meta as $name => $content) {
                if($name=="og:title"){
                ?>
                <title>{{$content}}</title>
                <?php }?>
                <meta {{$type}}="{{$name}}" content="{{$content}}">
                <?php
            }
        }
    }
} else {
    ?>
    <title>{{ config('app.name') }} - Test Store</title>
    <meta name="keywords" content="products, " />
    <meta name="description" content="{{ config('app.description') }}">
    <meta property="og:image" content="">
    <meta property="og:site_name" content="{{ config('app.name') }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ config('app.name') }} - Test Store"/>
    <meta property="og:url" content="{{Request::url()}}"/>
    <meta property="og:description" content="{{ config('app.description') }}">
    <meta name="twitter:title" content="{{ config('app.name') }} - Test Store"/>
    <meta name="twitter:description" content="{{ config('app.description') }}"/>
    <meta name="twitter:image" content="{{Request::url()}}">
    <meta name="twitter:card" content="summary">
<?php } ?>
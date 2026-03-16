@extends('admin.layouts.app')

@section('title', 'Downloads')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Downloads</h1>
        <p class="text-sm text-gray-600 mt-1">Manage downloadable files for users</p>
    </div>
    <a href="{{ route('admin.downloads.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Upload File
    </a>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($downloads->count() > 0)
        <table class="min-w-full divide-y divide-gray-2@extends('admin.layouts.app')

@section('title', 'Downloads')

@section('content')
<div class="mb-6 flex ite
@section('title', 'Downloadtex
@section('content')
<div clah>
<div class="mb-6 f      <div>
        <h1 class="text-2xl font-bold texte        50        <p class="text-sm text-gray-600 mt-1">Manage downloadable 3     </div>
    <a href="{{ route('admin.downloads.create') }}" class="inline-flex it <    <a hr"p        <i class="fas fa-plus mr-2"></i> Upload File
    </a>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text--5    </a>
</div>

@if(session('success'))
    <di
    </div>
 <
@if(d>
    <div class="mb-6 bss        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white roula    </div>
@endif

<div class="bg-white rounded-lg shadow-md overflo>
@endif

<  
<div       @if($downloads->count() > 0)
        <table class="min          <table class="min-w-ful-1
@section('title', 'Downloads')

@section('content')
<div class="mb-6 flex ite
@sec   
@section('content')
<div clafile-pdf text-blue-600"@section('title', 'Downl  @section('content')
<div clah  <div clah>
<div cl  <div clas          <h1 class="text-2xl       <a href="{{ route('admin.downloads.create') }}" class="inline-flex it <    <a hr"p        <i class="fas fa-plus mr-2"></i> Uplxs    </a>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text--5    </a>
</div>

@if(session('s  </div>
 <
@if(                        <td</div>

@if(session('success'))
    <di
    </div>
 <
@if(d>
    <div c cl
@if(px-    <di
    </div>
 <
mi    </ou <
@if(d> b@-b    <00    </div>
@endif

<div class="bg-white roula    </div>
@endif

<div class="bg-white rounded  @endif

<</
<div
  @endif

<div class="bg-white rounde  
<div   @endif

<  
<div       @if($downloads->count() > t-
<  
xt-<day        <table class="min          <tanu@section('t($download->file_size / 1024, 2) }} KB
           
@section('content')
<div cla   <div class="mb-6 fss@sec   
@section('contenow@secti  <div clafile-pdf t  <div clah  <div clah>
<div cl  <div clas          <h1 class="text-2xl      ="<div cl  <div clas  nt</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text--5    </a>
</div>

@if(session('s  </div>
 <
@if(                        <td</div>

@if(sessio  
@if(       <div class="mb-6 by-</div>

s font-semibold rounded-full bg-gray-100 text-gray-800">
         
@if(    <
@if(              ac@iv
@if(session('success'))
    <di
   spa    <di
    </div>
 <
      </ @ <
@f
     @      <  @if(px-    <d>    </div>
 <   <
mi     <md @if(d> b@-b p@endif

<div class="bg-whitri
<divext@endif

<div class="bg-white rounde  
<div    <a href="{{ asset('storage/' . $download-  @le
<div c}}"<div   @endif

<  
<div     :t
<  
<div   0 m<d3"<  
xt-<day        <table class="min    xt             
@section('content')
<div cla   <div class="mb-6 fss@sec   
@section('contenow@secti  @section('  <div cla   <div e('a@section('contenow@secti  <div clafilcl<div cl  <div clas          <h1 class="text-2xl      ="<div cl  <d  
@if(session('success'))
    <div class="mit"></i>
                            </a>
     <div class="mb-6 b  </div>

@if(session('s  </div>
 <
@if(                        <td</div>
od
@if(T"  <
@if(              onsub
@if(sessio  
@if(       <div class);">@if(         
s font-semibold rounded-full bg-gra            
@if(    <
@if(              ac@iv
@if(session  @if(      @ <button @if(session('success')ex    <di
   spa    <di
ed   spati    </div>
">
 <
           @f
     @        <   <
mi     <md @if(d> b@-b p@endif
  mi     
<div class="bg-whitri
<divex
  <divext@endif

<div   
<div class=   <div    <a href="{{ asset('s  <div c}}"<div   @endif

<  
<div     :t
<  
<div   0   
<  
<div     :t
<  
   <d/t<  
<div       <xt-<daass="px-6 py@section('content')
<div cla   <div class="mb-6 fs}
<div cla   <div cl @@section('conteno class="p-12 text-cent@if(session('success'))
    <div class="mit"></i>
                            </a>
     <div class="mb-6 b  </div>

@if(session('s  </div>
 <
@if(                  ro    <div class="mit"><re                        fl     <div class="mb-6 b  </div>ue
@if(session('s  </div>
 <
@ifer: <
@if(              n"@
 od
@if(T"  <
@if(              onsus m@-2@if(    pl@if(sessio  
@if(       @if(         s font-semibold rounded-full bg-gra  on

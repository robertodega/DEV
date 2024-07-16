@extends('templates.layout')

@section('title', 'Blade Templates')

@section('pageName', 'Blade Templates ( with base layout blade)')

@section('selectedBladeTag', 'selected')

@section('pageContent')

    <div class='guideDiv guideTxtDiv'>
        Utilizzo file <strong>blade</strong> php
    </div>
    <div class='guideDiv guideContentDiv'>
        <code class='respCode'>
            <pre>
public function staff(){
    $staff = $this->data;
    $title = 'Staff';
    return view('staffB', <strong>compact</strong>('title','staff'));
}
            </pre>
        </code>

        <code class='respCode'>
            <pre>
File 'staffB.blade.php':
------------------------
&lbrace;&lbrace;&dollar;title&rbrace;&rbrace;[ File Blade Php ]
&commat;if(&dollar;staff)
    &commat;foreach(&dollar;staff as &dollar;s)
        &lbrace;&lbrace;&dollar;s['name']&rbrace;&rbrace; &lbrace;&lbrace;&dollar;s['lastname']&rbrace;&rbrace;
    &commat;endforeach
&commat;endif
            </pre>
        </code>
    </div>

    <div class='guideDiv guideTxtDiv'>
        Ereditarietà <strong>blade</strong> php
    </div>
    <div class='guideDiv guideContentDiv'>
        <ul>
            <li>Costruire un blade di base ( es. resources/views/templates/<strong>layout.blade.php</strong> )</li>
            <li>Inserire nel blade di base tutte le parti comuni a tutte le pagine che erediteranno questo blade</li>
            <li>Inserire nel blade di base la sezione che verrà popolata dinamicamente tramite la direttiva <strong>&commat;yield</strong> dalle pagine che erediteranno questo blade</li>
            <li>Nelle pagine che erediteranno questo blade sarà presente una section con il nome del tag poplato dinamicamente</li>
            <p>
                Es.
                <li>in blade comune: <br />...<br /></strong>&commat;yield('tagName')</strong><br />...</li>
                <li>in blade che eredita il blade comune: <br />...<br /></strong>&commat;section('tagName')</strong><br />...<br />&commat;endsection<br />...</li>
            </p>
        </ul>
    </div>

@endsection

@extends("layout.index")
@section('content')
<link rel="stylesheet" href="{{ asset('css/userManagement.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

<div class="page">
    @include("userManagement.userList", ['weddings' => $weddings, 'users' => $users])
    @include('userManagement.weddingList', ['weddings' => $weddings, 'users' => $users])
    <div class="container">
        <button onclick="switchTable(1)">Weddinglijst</button>
        <button onclick="switchTable(2)">Gebruikerslijst</button>
        <div id="searchUsers" class="searchbar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" class="searchbar-input" id="queryUserList" onkeyup="searchBarUserList()" placeholder="Zoeken">
        </div>
        <div id="searchWeddings" class="searchbar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" class="searchbar-input" id="queryWeddingList" onkeyup="searchBarWeddingList()" placeholder="Zoeken">
        </div>
        <form id="form-dropdownUsers">
            <label for="dropdown"></label>
            <select class="dropdown" name="dropdown" id="dropdownUsers" onchange="sortTableUserList()">
                <option value="optie1">Sorteren op</option>
                <option value="optie2">Naam (A-Z)</option>
                <option value="optie3">Naam (Z-A)</option>
            </select>
        </form>
        <form id="form-dropdownWeddings">
            <label for="dropdown"></label>
            <select class="dropdown" name="dropdown" id="dropdownWeddings" onchange="sortTableWeddingList()">
                <option value="optie1">Sorteren op</option>
                <option value="optie2">Naam (A-Z)</option>
                <option value="optie3">Naam (Z-A)</option>
            </select>
        </form>

    </div>
    <div id="userList">
        @yield('userList')
    </div>
    <div id="weddingList">
        @yield('weddingList')
    </div>
</div>
<script>
    document.getElementById("pagina").innerHTML = "User Management"
    //Switch between weddinglist and userlist table
    function switchTable(table) {
        const userList = document.getElementById('userList')
        const weddingList = document.getElementById('weddingList')
        if (table === 1) {
            userList.style.display = 'none'
            weddingList.style.display = 'block'
            document.getElementById('searchUsers').style.display = 'none'
            document.getElementById('searchWeddings').style.display = 'inline'
            document.getElementById('form-dropdownUsers').style.display = 'none'
            document.getElementById('form-dropdownWeddings').style.display = 'inline'
        } else if (table === 2) {
            userList.style.display = 'block'
            weddingList.style.display = 'none'
            document.getElementById('searchUsers').style.display = 'inline'
            document.getElementById('searchWeddings').style.display = 'none'
            document.getElementById('form-dropdownUsers').style.display = 'inline'
            document.getElementById('form-dropdownWeddings').style.display = 'none'
        }
    }

    window.onload = weddingCodeSort() + dateSort();
</script>
@endsection


    <nav id="sidebar" class="marg">
        <div class="fixed-part">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
            <p><a href="logout">Logout</a></p>
        </div>

        <ul class="list-unstyled components">
            <p>Welcome</p>

            <li>
                <a href="dashboard">Home</a>
            </li>
            <li>
                <a href="{{URL('all-manuscript')}}">All Manuscript</a>
            </li>
            <li>
                <a href="{{URL('receive-editors')}}">Editor Request Receive</a>
            </li>
            <li>
                <a href="{{URL('receive-reviewers')}}">Reviewer Request Receive</a>
            </li>
            <li>
                <a href="#journalsSubmenu" data-toggle="collapse" aria-expanded="false">Journals</a>
                <ul class="collapse list-unstyled" id="journalsSubmenu">
                    <li><a href="{{URL('journalForm')}}">Add Journals</a></li>
                    <li><a href="Checkjournals">Update Journals</a></li>
                    <!-- <li><a href="#">Check All Journals</a></li> -->
                </ul>
            </li>
            <li>
                <a href="#editorsSubmenu" data-toggle="collapse" aria-expanded="false">Editors</a>
                <ul class="collapse list-unstyled" id="editorsSubmenu">
                    <li><a href="{{URL('addEditors')}}">Add Editors</a></li>
                    <!-- <li><a href="allEditors">Update Editors</a></li>
                    <li><a href="#">Check All Editors</a></li> -->
                </ul>
            </li>
            <!-- <li>
                <a href="#slidersSubmenu" data-toggle="collapse" aria-expanded="false">Slider Editors</a>
                <ul class="collapse list-unstyled" id="slidersSubmenu">
                    <li><a href="slider-editors">Add Slider Editors</a></li>
                    <li><a href="all-slider-editors">Update Slider Editors</a></li>
                    <li><a href="#">Check All Slider Editors</a></li>
                </ul>
            </li> -->



            <li>
                <a href="#volumeSubmenu" data-toggle="collapse" aria-expanded="false">Volume</a>
                <ul class="collapse list-unstyled" id="volumeSubmenu">
                    <li><a href="{{URL('add-volume')}}">Add Volume</a></li>
                    <!-- <li><a href="#">Add Issues</a></li>
                    <li><a href="#">Add Journals</a></li> -->
                </ul>
            </li>

            <li>
                <a href="{{URL('home-article')}}">Home page Article</a>
            </li>


            <li>
                <a href="{{URL('indexing')}}">Indexing</a>
            </li>

            <li>
                <a href="{{URL('book')}}">Add Book</a>
            </li>



        </ul>

</div>
    </nav>




<!-- Page Content Holder -->
<div id="content" class="marg2">

    <nav class="navbar navbar-default" style="position: fixed;  height: 1px;">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                    <i class="glyphicon glyphicon-align-left"></i>
                    <span>Show/Hide Menu</span>
                </button>
            </div>
        </div>
    </nav>
<div id="page-content">
                <section class="container">
                    <header>
                        <ul class="nav nav-pills">
                            <li class="active"><a href="http://<?=$_SERVER['SERVER_NAME']?>/vendor/"><h1 class="page-title">Manage Businesses</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/vendor/manageusers/"><h1 class="page-title">Add/Edit Vendor Users</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/vendor/marketingtools/"><h1 class="page-title">Marketing Tools</h1></a></li>
                            <li><a href="http://<?=$_SERVER['SERVER_NAME']?>/vendor/addlisting/"><h1 class="page-title">Add Business Listing</h1></a></li> 
                        </ul>
                    </header> 
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <aside id="sidebar">
                                <ul class="navigation-sidebar list-unstyled">
                                    <li>
                                        <a href="">
                                            <i class="fa fa-user-md"></i>
                                            <span>Welcome, <?=$this->session->userdata("fullname")?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-gear"></i>
                                            <span>Modify My Account</span>
                                        </a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-md-9 col-sm-9">





                            <header>
                                <h1 class="page-title">Submit Item</h1>
                            </header>
                            <form id="form-submit" role="form" method="post" action="?" enctype="multipart/form-data">
                                <section>
                                    <h3>Address & Contact</h3>
                                    <div class="row">
                                        <div class="form-group large">
                                            <label for="title">Address</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>
                                    </div>
                                    <!--/.row-->
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label for="phone-number">Phone Number</label>
                                                <input type="text" class="form-control" id="phone-number" name="phone-number" pattern="\d*">
                                            </div>
                                        </div>
                                        <!--/.col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label for="email">Customer Support E-Mail</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <!--/.col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <label for="website">Website</label>
                                                <input type="text" class="form-control" id="website" name="website">
                                            </div>
                                        </div>
                                        <!--/.col-md-4-->
                                    </div>
                                    <!--/.row-->
                                </section>
                                <!--/#address-contact--> 
                                <section>
                                    <h3>Features</h3>
                                    <ul class="list-unstyled checkboxes">
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="1">Free Parking</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="2">Cards Accepted</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="3">Wi-Fi</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="4">Air Condition</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="5">Reservations</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="6">Team-buildings</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="7">Places to seat</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="8">Winery</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="9">Draft Beer</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="10">LCD</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="11">Saloon</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="12">Free Access</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="13">Terrace</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="14">Minigolf</label></div></li>
                                        <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="15">Night Bar</label></div></li>
                                    </ul>
                                </section> 
                                <!--Gallery-->
                                <section>
                                    <h3>Gallery</h3>
                                    <div id="file-submit" class="dropzone">
                                        <input name="file" type="file" multiple>
                                        <div class="dz-default dz-message"><span>Click or Drop Images Here</span></div>
                                    </div>
                                </section>
                                <!--end Gallery-->
                                <!--Opening Hours-->
                                <section>
                                    <h3>Opening Hours</h3>
                                    <div class="opening-hours">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr class="day">
                                                    <td class="day-name">Monday</td>
                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                    <td class="non-stop"><div class="checkbox">
                                                        <label>
                                                            <input type="checkbox">Non-stop
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <!--/.day-->
                                                <tr class="day">
                                                    <td class="day-name">Tuesday</td>
                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                    <td class="non-stop"><div class="checkbox">
                                                        <label>
                                                            <input type="checkbox">Non-stop
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <!--/.day-->
                                                <tr class="day">
                                                    <td class="day-name">Wednesday</td>
                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                    <td class="non-stop"><div class="checkbox">
                                                        <label>
                                                            <input type="checkbox">Non-stop
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <!--/.day-->
                                                <tr class="day">
                                                    <td class="day-name">Thursday</td>
                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                    <td class="non-stop"><div class="checkbox">
                                                        <label>
                                                            <input type="checkbox">Non-stop
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <!--/.day-->
                                                <tr class="day">
                                                    <td class="day-name">Friday</td>
                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                    <td class="non-stop"><div class="checkbox">
                                                        <label>
                                                            <input type="checkbox">Non-stop
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <!--/.day-->
                                                <tr class="day weekend">
                                                    <td class="day-name">Saturday</td>
                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                    <td class="non-stop"><div class="checkbox">
                                                        <label>
                                                            <input type="checkbox">Non-stop
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <!--/.day-->
                                                <tr class="day weekend">
                                                    <td class="day-name">Sunday</td>
                                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                                    <td class="non-stop"><div class="checkbox">
                                                        <label>
                                                            <input type="checkbox">Non-stop
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <!--/.day-->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                                <!--end Opening Hours-->
                                <hr>
                                <section>
                                    <figure class="pull-left margin-top-15">
                                        <p>By clicking “Submit & Pay” button you agree with <a href="terms-conditions.html" class="link">Terms & Conditions</a></p>
                                    </figure>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default pull-right" id="submit">Submit & Pay</button>
                                    </div>
                                    <!-- /.form-group -->
                                </section>
                            </form>
                            <!--/#form-submit-->



                        </div>
                    </div>
                </section>
            </div>
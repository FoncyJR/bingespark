<div class='mb-3'>
                                            <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST' name='form'>
                                                <div class='panel-body' id='profile-panel-body'>
                                                    <input type='text' class='form-control' name='title' placeholder='Movie Title'>
                                                </div>
                                                <div class='panel-body' id='profile-panel-body'>
                                                    <input type='number' class='form-control' name='release-year' placeholder='Release Year'>
                                                </div>
                                                <div class='panel-body' id='profile-panel-body'>
                                                    <input type='number' class='form-control' name='runtime' placeholder='Runtime (mins)'>
                                                </div>
                                                <div class='panel-body' id='profile-panel-body'>
                                                    <input type='number' class='form-control' name='revenue' placeholder='Revenue (millions)'>
                                                </div>
                                                <div class='panel-body' id='profile-panel-body'>
                                                    <input type='text' class='form-control' name='description' placeholder='Movie Description'>
                                                </div>
                                                <div class='panel-body' id='profile-panel-body'>
                                                    <div class='mb-3'>
                                                        <label for='formFile' class='form-label'>Movie Poster</label>
                                                        <input class='form-control' type='file' id='formFile' id='upload-btn'>
                                                    </div>
                                                </div>
                                                <div class='panel-body' id='profile-panel-body'>
                                                    <button type='submit' class='btn btn-primary' name='submitform'>Submit Movie</button>
                                                </div>
                                            </form>
                                        </div>
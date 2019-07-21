                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th colspan="2">Change Role?</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php viewAllUsers(); ?>
                        </tbody>                            
                        </table>
                        
                        <?php changeToAdmin(); ?>
                        <?php changeToSubscriber(); ?>
                        <?php deleteUser(); ?>
<div class="portlet light">
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="index.php?nav=<?= base64_encode("generate_pdf") ?>&generate_pdf=<?= $fetchUser['user_id'] ?>" class="btb btn-primary btn-lg">Generate PDF</a>
            </div>
        </div>

        <div class="hidden-print btn-group pull-right">
            <a style="font-size: 12px" href="#!" onclick="window.print()" class="btn btn-warning"><span class="fa fa-print"></span> Print</a>
            <a style="font-size: 12px" href="#!" onclick="takeScreenshot()" class="btn btn-info"><span class="fa fa-camera"></span> Take Screenshot</a>
            <button style="font-size: 12px" class="btn btn-danger pdf_portrait_btn hidden-print">Export PDF</button>
        </div>
    </div>
    <?php if (!empty($_REQUEST['generate_pdf'])) : {
            $summary = fetchRecord($dbc, "executive_summary", 'user_id', $fetchUser['user_id']);
            $research_interests = fetchRecord($dbc, "research_interests", 'user_id', $fetchUser['user_id']);
            $personal_mission = fetchRecord($dbc, "personal_mission", 'user_id', $fetchUser['user_id']);
        } ?>
        <div class="portlet-body" id="pdfBodyPortrait">
            <div class="container">
                <h3>Instructions:</h3>
                <ol>
                    <li>Submit the dossier in hard and soft copy to the HR section of Registrar office (hrm@ntu.edu.pk)</li>
                    <li>Attach all necessary relevant documents.</li>
                    <li>Attach first page of published papers</li>
                    <li>Extra sheets/columns may be added of the same formats if required. </li>
                    <li>Mention reporting year/period.</li>
                    <li>Faculty members submitting their dossier for consideration on fast track
                        promotion/appointment as per HEC criteria need to submit an application along
                        with dossier. </li>
                </ol>
                <h3>Reporting period: From: 1 January 202217 to 31 December 2022</h3>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-2">(dd-mm-yyyy) </div>
                    <div class="col-2"> (dd-mm-yyyy)
                    </div>
                    <div class="col-4"></div>
                </div>
                <h3 class="mt-5">TO BE FILLED BY THE APPLICANT IN BLOCK LETTERS</h3>
                <hr>
                <table class="border" width="100%" style="border-color: black;">
                    <tr>
                        <th style="font-size: 25px; background-color: gray;" colspan="3"><strong>A:PERSONAL DETAILS</strong></th>

                    </tr>
                    <tr>
                        <td>Name:ABC_</td>
                        <td> Father name:ABC_</td>
                    </tr>


                    <tr>
                        <td>DOB: 00 MAY 0000</td>
                        <td> Age: 43 YEARS </td>
                        <td>CNIC #</td>
                    </tr>
                    <tr>
                        <td>Domicile: FAISALABAD</td>
                        <td> Nationality: __________
                        </td>

                    </tr>

                    <tr>
                        <td>Designation: Pay Scale: 19-TTS</td>
                    </tr>


                    <tr>
                        <td>Department: COMPUTER SCIENCE </td>
                        <td> Date of Appointment at NTU: 16 JANUARY 0000
                        </td>

                    </tr>

                    <tr>
                        <td>Total Post PhD Experience: 0 YEARS & 0 MONTH </td>
                    </tr>

                    <tr>
                        <td>Total service on TTS: 6 YEAR </td>
                    </tr>

                    <tr>
                        <td>Total service as Assistant Professor: 6 YEAR</td>
                    </tr>

                    <tr>
                        <td>Mid Term review (if applicable): YES COMPLETE </td>
                    </tr>

                    <tr>
                        <td>Postal Address:_________________ </td>
                    </tr>
                    <tr>
                        <td>Permanent Address:______________________________ </td>
                    </tr>

                    <tr>
                        <td>Email: ____________________ </td>
                        <td>Telephone (Res/office). Cell no. _____________________________
                        </td>
                    </tr>
                </table>



                <!-- container -->
            </div>
            <div class="container">
                <h3>Table of Contents</h3>

                <ol>
                    <li> Highlights of the profile......................................................................................................................................................4 </li>


                    <ol>
                        <li>Executive Summary..................................................................................................................................................4</li>
                        <li>Research....................................................................................................................................................................6</li>
                        <ol>
                            <li>Research Interest.............................................................................................................................................6</li>
                            <li>Research Achievement....................................................................................................................................6</li>
                        </ol>

                        <li>Academic...................................................................................................................................................................6</li>
                        <li>Other Contributions...................................................................................................................................................7</li>
                    </ol>

                    <li>Personal Mission.................................................................................................................................................................7</li>
                    <li>Academic Qualifications.....................................................................................................................................................8</li>
                    <li>Professional Experience......................................................................................................................................................9</li>
                    <li>Teaching Profile.................................................................................................................................................................10</li>

                    <ol>
                        <li>Statement of Teaching..............................................................................................................................................10</li>
                        <li>Detail of course Taught............................................................................................................................................10</li>
                        <li>Detail of new courses developed..............................................................................................................................11</li>
                        <li>Curriculum development & Review.........................................................................................................................11</li>
                        <li>Trainings & Certificate (Attented)............................................................................................................................11</li>
                    </ol>
                    <li>Research Profile..................................................................................................................................................................11</li>
                    <ol>
                        <li>Research Statement...................................................................................................................................................12</li>
                        <li>Research Out put.......................................................................................................................................................12</li>
                        <li>Books Chapter Authored...........................................................................................................................................12</li>
                        <li>Funded Research Projects (in progress)....................................................................................................................13</li>
                        <li>Funded Research Projects (Completed)....................................................................................................................13</li>
                        <li>Patents........................................................................................................................................................................13</li>
                        <li>Research Supervison..................................................................................................................................................13</li>

                        <ol>
                            <li>PhD Thesis completed (As supervisor)............................................................................................................13</li>
                            <li>PhD Thesis completed (As Co-supervisor)......................................................................................................13</li>
                            <li>PhD Thesis progress(As supervisor)................................................................................................................13</li>
                            <li>MS Thesis Completed (As supervisor).............................................................................................................14</li>
                            <li>MS Thesis Completed (As Co-supervisor).......................................................................................................14</li>
                        </ol>

                        <li>Reviewer of the research articles................................................................................................................................15</li>
                        <li>External Examiner/Referee of MS/PhD Thesis...........................................................................................................15</li>
                    </ol>

                    <li>Administration/other contributions........................................................................................................................................15</li>
                    <ol>
                        <li>MOU's/Collaboration established with National and International Organization.......................................................16</li>
                        <li>Initiatives Taken...........................................................................................................................................................16</li>
                        <li>Confrence/Exhibitions Organized (As Organzier).......................................................................................................16</li>
                        <li>Member technical committee of international conference...........................................................................................16</li>
                        <li>Award & Honors...........................................................................................................................................................16</li>
                        <li>Professional training conducted for industry................................................................................................................16</li>
                        <li>Other Services...............................................................................................................................................................16</li>
                    </ol>


                    <li>List os Journal Articles............................................................................................................................................................18</li>
                    <li>Paper presented in conferences................................................................................................................................................20</li>

                </ol>
            </div>
            <!-----------------(1) Highlights of Profile--------------------->
            <div class="container">
                <h3>(1) Highlights of Profile</h3>
                <br>
                <h4>(1.1) Executive Summary</h4>
                <?= @$summary['summary'] ?>
            </div>
            <div class="container">
                <h3>(1.2) Research</h3>
                <h4>(1.2)1. Research interests</h4>
                <?= $research_interests['research_interests'] ?>
                <h4 class=''>(1.2)2. Research Achievements</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">Textile Engineering, knitting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($researchData); $i++) : ?>
                                <tr>
                                    <td><?= $researchData[$i]; ?></td>
                                    <td style="padding: 0;">
                                        <table class="table table-bordered" cellspacing="0" height="100%">
                                            <?php
                                            $sql = "SELECT * FROM research_data WHERE user_id = $fetchUser[user_id] and research_domain_title = '$researchData[$i]'   ";
                                            $q = mysqli_query($dbc, $sql);
                                            while ($row = mysqli_fetch_assoc($q)) :
                                                $data1 = json_decode($row['research_domain_data']);
                                                foreach ($data1 as $value) :
                                                    $value = (array) $value;
                                            ?>
                                                    <tr>
                                                        <td style="width: 50%;"><?= $value['research_domain_text'] ?></td>
                                                        <td style="width: 50%;"><?= $value['research_domain_details'] ?></td>
                                                    </tr>
                                            <?php endforeach;
                                            endwhile;
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                            <?php
                            endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <h3>(1.3) Academic</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($academicData); $i++) : ?>
                                <tr>
                                    <td><?= $academicData[$i]; ?></td>
                                    <td style="padding: 0;">
                                        <table class="table table-bordered" cellspacing="0" height="100%">
                                            <?php
                                            $sql = "SELECT * FROM academic_data WHERE user_id = $fetchUser[user_id] and academic_domain_title = '$academicData[$i]'   ";
                                            $q = mysqli_query($dbc, $sql);
                                            while ($row = mysqli_fetch_assoc($q)) :
                                                $data1 = json_decode($row['academic_domain_data']);
                                                foreach ($data1 as $value) :
                                                    $value = (array) $value;
                                            ?>
                                                    <tr>
                                                        <td style="width: 50%;"><?= $value['research_domain_text'] ?></td>
                                                        <td style="width: 50%;"><?= $value['research_domain_details'] ?></td>
                                                    </tr>
                                            <?php endforeach;
                                            endwhile;
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                            <?php
                            endfor; ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="container">
                <h3>(1.4) Other contributions</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">Textile Engineering, knitting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($otherContributions); $i++) : ?>
                                <tr>
                                    <td style="width:40%"><?= $otherContributions[$i]; ?></td>
                                    <td style="padding: 0;">
                                        <table class="table table-bordered" cellspacing="0" height="100%">
                                            <?php
                                            $sql = "SELECT * FROM other_contributions WHERE user_id = $fetchUser[user_id] and contributions_domain_title = '$otherContributions[$i]'   ";
                                            $q = mysqli_query($dbc, $sql);
                                            while ($row = mysqli_fetch_assoc($q)) :
                                                $data1 = json_decode($row['contributions_domain_data']);
                                                foreach ($data1 as $value) :
                                                    $value = (array) $value;
                                            ?>
                                                    <tr>
                                                        <td style="width: 50%;"><?= $value['research_domain_text'] ?></td>
                                                        <td style="width: 50%;"><?= $value['research_domain_details'] ?></td>
                                                    </tr>
                                            <?php endforeach;
                                            endwhile;
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                            <?php
                            endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <h3>(2) Personal Mission</h3>
                <?= $personal_mission['summary'] ?>
            </div>
            <div class="container">
                <h3>(3) Academic Qualification</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Degree </th>
                                <th class="text-center">Research Thesis/ Project Title </th>
                                <th class="text-center">University </th>
                                <th class="text-center">Major Field/Subjects </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM academic_qualification WHERE user_id = $fetchUser[user_id]";
                            $q = mysqli_query($dbc, $sql);
                            while ($row = mysqli_fetch_assoc($q)) :
                            ?>
                                <tr>
                                    <td><?= $row['degree'] ?></td>
                                    <td><?= $row['research'] ?></td>
                                    <td><?= $row['university'] ?></td>
                                    <td><?= $row['major_field'] ?></td>
                                </tr>

                            <?php
                            endwhile;
                            ?>
                            <tr>
                                <td>Certifications</td>
                            </tr>
                            <?php
                            $sql = "SELECT * FROM certifications WHERE user_id = $fetchUser[user_id]";
                            $cq = mysqli_query($dbc, $sql);
                            while ($crow = mysqli_fetch_assoc($cq)) :
                            ?>
                                <tr>
                                    <td><?= $crow['cdegree'] ?></td>
                                    <td><?= $crow['cresearch'] ?></td>
                                    <td><?= $crow['cuniversity'] ?></td>
                                    <td><?= $crow['cmajor_field'] ?></td>
                                </tr>

                            <?php
                            endwhile;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <h3></h3>
            </div>
        </div>
    <?php endif; ?>
</div>
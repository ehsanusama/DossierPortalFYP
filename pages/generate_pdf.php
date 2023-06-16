<style>
    body {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    .row {
        justify-content: center;
    }

    .ctn2 p,
    .rp p,
    .from p,
    .to p {
        font-size: 19px;
        font-weight: 700;
        font-style: italic;
    }

    table {
        width: 100%;
    }

    table tr td {
        padding: 10px;
        font-weight: 500;
    }

    tbody {
        border: 1px solid black;
    }

    .container {
        width: 100% !important;
        margin: 0;
        padding: 0;
    }
</style>

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

</div>

<div class="portlet light">
    <?php if (!empty($_REQUEST['generate_pdf'])) : {
            $summary = fetchRecord($dbc, "executive_summary", 'user_id', $fetchUser['user_id']);
            $research_interests = fetchRecord($dbc, "research_interests", 'user_id', $fetchUser['user_id']);
            $personal_mission = fetchRecord($dbc, "personal_mission", 'user_id', $fetchUser['user_id']);
            $statement_teaching = fetchRecord($dbc, "statement_teaching", 'user_id', $fetchUser['user_id']);
        } ?>
        <span id="pdfBodyPortrait">
            <div class="portlet-body">

                <div class="container" style="padding: 0 140px; margin-top: 40px;">
                    <div class="row">
                        <div class="col-4" style="text-align: center; width: 20%;"><img src="img/nut-img.jpg" alt="" width="150px" height="150px">
                            <!-- logo -->
                        </div>
                        <div class="col-7" style=" text-align: center;  margin-top: -25px;">
                            <h1 class="mt-5" style="font-size: 32px;">
                                NATIONAL TEXTILE UNIVERSITY
                            </h1>
                            <center>
                                <h4>Dossier Form</h4>
                            </center>
                            <p style="font-size: 18px;
                    color: blue; 
                    font-weight: 500;
                    ">(Evaluation of Mid / End Term / Appointment of Assistant/Associate/ Full
                                Professor)</p>
                        </div>
                    </div>
                    <h3 style="font-size: 25px;">Instructions:</h3>
                    <ol type="i" style="padding: 0 71px;width:100%">
                        <li>Submit the dossier in hard and soft copy to the HR section of Registrar office <a href="#" style="font-weight: 500;">(hrm@ntu.edu.pk)</a></li>
                        <li>Attach all necessary relevant documents.</li>
                        <li>Attach first page of published papers</li>
                        <li>Extra sheets/columns may be added of the same formats if required. </li>
                        <li>Mention reporting year/period.</li>
                        <li>Faculty members submitting their dossier for consideration on fast track
                            promotion/appointment as per HEC criteria need to submit an application along
                            with dossier. </li>
                    </ol>

                    <div class="container ctn2" style="display: flex; padding: 0;">
                        <div class="rp">
                            <p>Reporting period:</p>
                        </div>
                        <div class="" style="text-align: end; padding: 0 15px;">
                            <p>From: 1 January 2022</p>
                            <p style="margin-top: -13px;">(dd-mm-yyyy)</p>
                        </div>
                        <p>to</p>
                        <div class="" style="text-align: end; padding: 0 15px;">
                            <p>31 December 2022</p>
                            <p style="margin-top: -13px;">(dd-mm-yyyy)</p>
                        </div>

                    </div>
                    <h3 class="mt-2" style="font-size: 21px; text-decoration: underline;">TO BE FILLED BY THE APPLICANT IN BLOCK LETTERS</h3>
                    <hr style="    opacity: 1;margin: 9px 0;">
                    <table class="border" width="100%" style="width: 100%;text-transform:capitalize">
                        <tr>
                            <th style="font-size: 18px;background-color: #ddd;padding: 15px 4px;font-weight: 500; " colspan="3">A: PERSONAL DETAILS</th>

                        </tr>
                        <?php @$fetchUserExtra = (array) json_decode($fetchUser['user_extra']); ?>
                        <tr>
                            <td style="width: 39%;">Name:<?= @$fetchUser['user_first_name'] ?></td>
                            <td> Father name: <?= @$fetchUser['user_last_name'] ?></td>
                        </tr>


                        <tr>
                            <td>DOB: <?= @$fetchUser['user_dob'] ?></td>
                            <td style="width: 5%;"> Age: <?= @$fetchUserExtra['age'] ?> </td>
                            <td style="position: absolute; left: 53%;">CNIC # <?= @$fetchUserExtra['cnic'] ?> </td>
                        </tr>
                        <tr>
                            <td>Domicile: <?= @$fetchUserExtra['domicile'] ?></td>
                            <td> Nationality: <?= @$fetchUserExtra['nationality'] ?>
                            </td>

                        </tr>

                        <tr>
                            <td>Designation: <?= @$fetchUser['designation'] ?></td>
                        </tr>


                        <tr>
                            <td>Department: <?= @$fetchUserExtra['department'] ?> </td>
                            <td style="width: 50%;"> Date of Appointment at NTU: <?= @$fetchUserExtra['ntu'] ?>
                            </td>

                        </tr>

                        <tr>
                            <td>Total Post PhD Experience: <?= @$fetchUserExtra['phd_experience'] ?> </td>
                        </tr>

                        <tr>
                            <td>Total service on TTS: <?= @$fetchUserExtra['tts_service'] ?> </td>
                        </tr>

                        <tr>
                            <td>Total service as Assistant Professor: <?= @$fetchUserExtra['assistant_professor'] ?></td>
                        </tr>

                        <tr>
                            <td style="width: 31%;">Mid Term review (if applicable): <?= @$fetchUserExtra['mid_term_review'] ?> </td>
                        </tr>

                        <tr>
                            <td>Postal Address: <?= @$fetchUser['user_address'] ?> </td>
                        </tr>
                        <tr>
                            <td>Permanent Address: <?= @$fetchUser['user_address'] ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Email: <?= @$fetchUser['user_email'] ?> </td>
                            <td>Telephone (Res/office). Cell no. <?= @$fetchUser['user_phone'] ?>
                            </td>
                        </tr>
                    </table>

                    <!-- container -->
                </div>
                <div class="container" style="padding: 0 140px; margin-top: 40px;">
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
                <!-------------------------------------->

                <div class="container">
                    <h3>(1.2) Research</h3>
                    <h4>(1.2)1. Research interests</h4>
                    <?= @$research_interests['research_interests'] ?>
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
                                                            <td style="width: 50%;"><?= @$value['research_domain_text'] ?></td>
                                                            <td style="width: 50%;"><?= @$value['research_domain_details'] ?></td>
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
                <!-------------------------------------->
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
                                                            <td style="width: 50%;"><?= @$value['research_domain_text'] ?></td>
                                                            <td style="width: 50%;"><?= @$value['research_domain_details'] ?></td>
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
                <!-------------------------------------->
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
                                                            <td style="width: 50%;"><?= @$value['research_domain_text'] ?></td>
                                                            <td style="width: 50%;"><?= @$value['research_domain_details'] ?></td>
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
                <!-------------------------------------->

                <div class="container">
                    <h3>(2) Personal Mission</h3>
                    <?= @$personal_mission['summary'] ?>
                </div>
                <!-------------------------------------->

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
                <!-------------------------------------->

                <div class="container">
                    <h3>(4) Professional Experience</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Name of Institution </th>
                                    <th class="text-center">Position Held </th>
                                    <th class="text-center">Duties </th>
                                    <th class="text-center">From </th>
                                    <th class="text-center">To </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM professional_experience WHERE user_id = $fetchUser[user_id]";
                                $professional_experience_q = mysqli_query($dbc, $sql);
                                while ($row = mysqli_fetch_assoc($professional_experience_q)) :
                                ?>
                                    <tr>
                                        <td><?= @$row['institute'] ?></td>
                                        <td><?= @$row['position'] ?></td>
                                        <td><?= @$row['duties'] ?></td>
                                        <td><?= @$row['year_from'] ?></td>
                                        <td><?= @$row['year_to'] ?></td>
                                    </tr>

                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-------------------------------------->

                <div class="container">
                    <h2>(5) Teaching Profile</h2>
                    <h3>(5.1) Statement of Teaching:</h3>
                    <?= @$statement_teaching['statement_teaching_text'] ?>
                </div>
                <!-------------------------------------->

                <div class="container">
                    <h3>(5.2) Detail of Courses Taught</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Course Title </th>
                                    <th class="text-center">Credit Hours </th>
                                    <th class="text-center">Teaching Hours (since 20xx) </th>
                                    <th class="text-center">PhD/MS/BS </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM taught_course_details WHERE user_id = $fetchUser[user_id]";
                                $q = mysqli_query($dbc, $sql);
                                while ($row = mysqli_fetch_assoc($q)) :
                                ?>
                                    <tr>
                                        <td><?= @$row['title'] ?></td>
                                        <td><?= @$row['credit_hour'] ?></td>
                                        <td><?= @$row['teaching_hour'] ?></td>
                                        <td><?= @$row['phd_ms_bs'] ?></td>
                                    </tr>

                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-------------------------------------->

                <div class="container">
                    <h3>(5.3) Detail of New Courses Developed</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Course Title </th>
                                    <th class="text-center">Credit Hours </th>
                                    <th class="text-center">PhD/MS/BS </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM develop_course_details WHERE user_id = $fetchUser[user_id]";
                                $q = mysqli_query($dbc, $sql);
                                while ($row = mysqli_fetch_assoc($q)) :
                                ?>
                                    <tr>
                                        <td><?= @$row['title'] ?></td>
                                        <td><?= @$row['credit_hour'] ?></td>
                                        <td><?= @$row['phd_ms_bs'] ?></td>
                                    </tr>

                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-------------------------------------->

                <div class="container">
                    <h3>(5.4) Curriculum Development & Review</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Role </th>
                                    <th class="text-center">Organization </th>
                                    <th class="text-center">Duties </th>
                                    <th class="text-center">From </th>
                                    <th class="text-center">To </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM curriculum_develop WHERE user_id = $fetchUser[user_id]";
                                $q = mysqli_query($dbc, $sql);
                                while ($row = mysqli_fetch_assoc($q)) :
                                ?>
                                    <tr>
                                        <td><?= @$row['institute'] ?></td>
                                        <td><?= @$row['position'] ?></td>
                                        <td><?= @$row['duties'] ?></td>
                                        <td><?= @$row['year_from'] ?></td>
                                        <td><?= @$row['year_to'] ?></td>
                                    </tr>

                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-------------------------------------->

                <div class="container">
                    <h3>(5.5) Trainings & Certificates (Attended) / Conducted</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="col-md-4" class="text-center">Details </th>
                                    <th class="text-center">File </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM traning_conducted WHERE user_id = $fetchUser[user_id]";
                                $q = mysqli_query($dbc, $sql);
                                while ($row = mysqli_fetch_assoc($q)) :
                                ?>
                                    <tr>
                                        <td colspan="col-md-4"><?= $row['details'] ?></td>
                                        <td><?= $row['file'] ?></td>

                                    </tr>

                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-----------------Annexure 1:--------------------->

                <div class="container">
                    <h3>Annexure 1:</h4>
                        <h4>Administrative / Non-academic departmental duties</h4>
                        <?php
                        $sql = "SELECT * FROM other_contributions WHERE user_id = $fetchUser[user_id]";
                        $q = mysqli_query($dbc, $sql);
                        while ($row = mysqli_fetch_assoc($q)) :
                            $data1 = json_decode($row['contributions_domain_data']);
                            foreach ($data1 as $key => $value) {
                                if ($key === 'file') {
                                    foreach ($value as $document) {
                                        $containerPath = "img/uploads/";
                                        $file = $containerPath . $document;
                                        $pdfFilePath = $file;
                                        // Generate the HTML code for embedding the PDF
                                        $html = '<iframe src="' . $pdfFilePath . '" style="width: 100%;height:1122px" scrolling="off" ></iframe>';
                                        // Output the HTML code
                                        echo $html;
                                    }
                                }
                            }
                        endwhile;
                        ?>
                </div>
                <!-----------------Annexure 2:--------------------->

                <div class="container">
                    <h3>Annexure 2:</h4>
                        <h4>Academic Qualification</h4>
                        <?php
                        $sql = "SELECT * FROM academic_qualification WHERE user_id = $fetchUser[user_id]";
                        $q = mysqli_query($dbc, $sql);
                        while ($row = mysqli_fetch_assoc($q)) :
                            $containerPath = "img/uploads/";
                            $file = $containerPath . $row['file'];
                            $pdfFilePath = $file;
                            // Generate the HTML code for embedding the PDF
                            $html = '<iframe src="' . $pdfFilePath . '" style="width: 100%;height:1122px" scrolling="off" ></iframe>';
                            // Output the HTML code
                            echo $html;
                        endwhile;
                        ?>
                </div>
                <!-----------------Annexure 3:--------------------->

                <div class="container">
                    <h3>Annexure 3:</h4>
                        <h4>Professional Experience</h4>
                        <?php
                        $sql = "SELECT * FROM professional_experience WHERE user_id = $fetchUser[user_id]";
                        $professional_experience_q = mysqli_query($dbc, $sql);
                        while ($row = mysqli_fetch_assoc($professional_experience_q)) :
                            $containerPath = "img/uploads/";
                            $file = $containerPath . $row['file'];
                            $pdfFilePath = $file;

                            // Generate the HTML code for embedding the PDF
                            $html = '<iframe src="' . $pdfFilePath . '" style="width: 100%; min-height:2700px" scrolling="off" ></iframe>';

                            // Output the HTML code
                            echo $html;

                        endwhile;
                        ?>
                </div>
                <!-----------------Annexure 4:--------------------->

                <div class="container">
                    <h3>Annexure 4:</h4>
                        <h4>Detail of Courses Taught</h4>
                        <?php
                        $sql = "SELECT * FROM taught_course_details WHERE user_id = $fetchUser[user_id]";
                        $professional_experience_q = mysqli_query($dbc, $sql);
                        while ($row = mysqli_fetch_assoc($professional_experience_q)) :
                            $containerPath = "img/uploads/";
                            $file = $containerPath . $row['document'];
                            $pdfFilePath = $file;
                            // Generate the HTML code for embedding the PDF
                            $html = '<iframe src="' . $pdfFilePath . '" style="width: 100%; min-height:2700px" scrolling="off" ></iframe>';
                            // Output the HTML code
                            echo $html;
                        endwhile;
                        ?>

                </div>
                <!-----------------Annexure 5:--------------------->

                <div class="container">
                    <h3>Annexure 5:</h4>
                        <h4>Trainings & Certificates (Attended) / Conducted</h4>
                        <?php
                        $sql = "SELECT * FROM traning_conducted WHERE user_id = $fetchUser[user_id]";
                        $professional_experience_q = mysqli_query($dbc, $sql);
                        while ($row = mysqli_fetch_assoc($professional_experience_q)) :
                            $containerPath = "img/uploads/";
                            $file = $containerPath . $row['file'];
                            $pdfFilePath = $file;
                            // Generate the HTML code for embedding the PDF
                            $html = '<iframe src="' . $pdfFilePath . '" style="width: 100%; min-height:2700px" scrolling="off" ></iframe>';
                            // Output the HTML code
                            echo $html;

                        endwhile;
                        ?>

                </div>
            </div>
        </span>
    <?php endif; ?>
</div>
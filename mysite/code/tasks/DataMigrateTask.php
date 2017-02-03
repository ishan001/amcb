<?php

class DataMigrateTask extends BuildTask
{

    protected $title = 'Data migrate Task';

    protected $description = 'Data migrate Task';

    public function run($request)
    {

        //before running the script
        //create teacher,news,gallery,event pages
        //upload the old database tables
        //create

        $teacherPageID = 6;
        $newsPageID = 7;
        $galleryPageID = 8;
        $eventPageID = 9;
        $groupID = 3;


        $result = DB::query('SELECT * FROM sports');
        foreach ($result as $item) {
            $sport = new Sport();
            $sport->ClassName = 'Sport';
            $sport->Title = $item['SP_NAME'];
            $sport->write();
        }

        $result = DB::query('SELECT * FROM subjects');
        foreach ($result as $item) {
            $subject = new Subject();
            $subject->ClassName = 'Subject';
            $subject->Title = $item['SB_TITLE'];
            $subject->write();
        }

        $Grades = array("1A", "1B", "1C", "2A", "2B", "2C", "3A", "3B", "3C", "4A", "4B", "4C", "5A", "5B", "5C",
            "6A", "6B", "6C-S", "6C-E", "6C", "7A", "7B", "7C-S", "7C-E", "7C", "8A", "8B", "8C-S", "8C-E", "8C", "9A", "9B", "9C-S", "9C-E", "9C",
            "10A", "10B", "10C-S", "10C-E", "10C", "11A", "11B", "11C-S", "11C-E", "11C", "12A", "12C", "13A", "13C", "12B", "13B");

        foreach ($Grades as $row) {
            $Grade = new Grade();
            $Grade->ClassName = 'Grade';
            $Grade->Title = $row;
            $Grade->write();
        }

        //insert folders

        $file = new File();
        $file->ClassName = 'Folder';
        $file->Name = 'Teachers';
        $file->Title = 'Teachers';
        $file->Filename = 'assets/Teachers/';
        $file->ParentID = 0;
        $file->OwnerID = 1;
        $file->write();
        $teacherFolderID = $file->ID;

        $file = new File();
        $file->ClassName = 'Folder';
        $file->Name = 'image-gallery';
        $file->Title = 'image-gallery';
        $file->Filename = "assets/image-gallery";
        $file->ParentID = 0;
        $file->OwnerID = 1;
        $file->write();
        $galleryFolderID = $file->ID;

        $file = new File();
        $file->ClassName = 'Folder';
        $file->Name = 'Students';
        $file->Title = 'Students';
        $file->Filename = 'assets/Students/';
        $file->ParentID = 0;
        $file->OwnerID = 1;
        $file->write();
        $studentFolderID = $file->ID;

        $file = new File();
        $file->ClassName = 'Folder';
        $file->Name = 'Events';
        $file->Title = 'Events';
        $file->Filename = 'assets/Events/';
        $file->ParentID = 0;
        $file->OwnerID = 1;
        $file->write();
        $eventFolderID = $file->ID;


        //update teachers
        $result = DB::query('SELECT * FROM teachers');
        foreach ($result as $item) {

            $gradeID = 0;
            if (!empty($item['T_JOINED_DATE'])) {
                $grade = Grade::get()->filter(array('Title' => $item['T_CLASS_TECH']))->first();
                if ($grade) {
                    $gradeID = $grade->ID;
                }
            }

            $teacher = new Teacher();

            $pic = $item['T_PRO_PIC'];
            $picID = 0;

            if (!empty($pic)) {
                $file = new File();
                $file->ClassName = 'Image';
                $file->Name = $pic;
                $file->Title = preg_replace('/\\.[^.\\s]{3,4}$/', '', $pic);
                $file->Filename = 'assets/Teachers/' . $pic;
                $file->ParentID = $teacherFolderID;
                $file->OwnerID = 1;
                $file->write();
                $picID = $file->ID;

            }

            $teacher->ClassName = 'Teacher';
            $teacher->TeacherName = $item['T_NAME'];
            $teacher->JoinedDate = $item['T_JOINED_DATE'];
            $teacher->Contact = $item['T_CONTACT'];
            $teacher->Email = $item['T_EMAIL'];
            $teacher->ClassTeacherID = $gradeID;
            $teacher->About = $item['T_DESCRIPTION'];
            $teacher->Qualifications = $item[' 	T_QUALIFICATION'];
            $teacher->ImageID = $picID;
            $teacher->TeachersPageID = $teacherPageID;
            $teacher->write();
            $teacherID = $teacher->ID;


            $t_classes = DB::query('SELECT TC_GRADE FROM teachers_classes where TC_T_ID = ' . $item["T_ID"] . ' GROUP BY TC_GRADE');
            foreach ($t_classes as $class) {

                $GID = Grade::get()->filter(array('Title' => $class['TC_GRADE']))->first()->ID;

                DB::query('insert into Teacher_Grades set TeacherID=' . $teacherID . ', GradeID = ' . $GID);
            }

            $t_classes = DB::query('SELECT TC_S_ID FROM teachers_classes where TC_T_ID = ' . $item["T_ID"] . ' GROUP BY TC_S_ID');
            foreach ($t_classes as $class) {

                DB::query('insert into Teacher_Subjects set TeacherID=' . $teacherID . ', SubjectID = ' . $class["TC_S_ID"]);
            }

        }

        //event
        $result = DB::query('SELECT * FROM events');
        foreach ($result as $item) {

            $pic = $item['E_IMAGE'];
            $picID = 0;

            if (!empty($pic)) {
                $file = new File();
                $file->ClassName = 'Image';
                $file->Name = $pic;
                $file->Title = preg_replace('/\\.[^.\\s]{3,4}$/', '', $pic);
                $file->Filename = 'assets/Events/' . $pic;
                $file->ParentID = $eventFolderID;
                $file->OwnerID = 1;
                $file->write();
                $picID = $file->ID;

            }

            $event = new Event();
            $event->ClassName = 'Event';
            $event->Title = $item['E_TITLE'];
            $event->Date = $item['E_DATE'];
            $event->Location = $item['E_LOCATION'];
            $event->Description = $item['E_DESCRIPTION'];
            $event->EventPageID = $eventPageID;
            $event->ImageID = $picID;
            $event->write();
        }

        //gallery
        $gal = DB::query('select * from gallery');

        foreach ($gal as $row) {

            $name = trim($row['G_NAME']);
            $filter = URLSegmentFilter::create();
            $URLSegment = $filter->filter($name);


            $file = new File();
            $file->ClassName = 'Folder';
            $file->Name = $URLSegment;
            $file->Title = $URLSegment;
            $file->Filename = "assets/image-gallery/{$URLSegment}";
            $file->ParentID = $galleryFolderID;
            $file->OwnerID = 1;
            $file->write();
            $FolderID = $file->ID;

            $alb = new ImageGalleryAlbum();
            $alb->ClassName = 'ImageGalleryAlbum';
            $alb->AlbumName = $name;
            $alb->URLSegment = $URLSegment;
            $alb->FolderID = $FolderID;
            $alb->ImageGalleryPageID = $galleryPageID;
            $alb->write();
            $album_id = $alb->ID;

            $gal_imgs = DB::query('SELECT * FROM gallery_images where GI_G_ID = ' . $row["G_ID"]);
            foreach ($gal_imgs as $img) {
                $pic = trim($img['GI_NAME']);
                $file1 = new File();
                $file1->ClassName = 'Image';
                $file1->Name = $pic;
                $file1->Title = preg_replace('/\\.[^.\\s]{3,4}$/', '', $pic);
                $file1->Filename = "assets/image-gallery/{$URLSegment}/{$pic}";
                $file1->ParentID = $FolderID;
                $file1->OwnerID = 1;
                $file1->write();
                $picID = $file1->ID;

                $img = new ImageGalleryItem();
                $img->ClassName = 'ImageGalleryItem';
                $img->ImageGalleryPageID = $galleryPageID;
                $img->AlbumID = $album_id;
                $img->ImageID = $picID;
                $img->write();
            }
        }


        //news
        $file = new File();
        $file->ClassName = 'Folder';
        $file->Name = 'News';
        $file->Title = 'News';
        $file->Filename = 'assets/News/';
        $file->ParentID = 0;
        $file->OwnerID = 1;
        $file->write();
        $newsFolderID = $file->ID;

        $result = DB::query('SELECT * FROM news');
        foreach ($result as $item) {

            $alb = new News();
            $alb->ClassName = 'News';
            $alb->Title = $item['N_TITLE'];
            $alb->Date = $item['N_DATE'];
            $alb->Description = $item['N_DESCRIPTION'];
            $alb->NewsPageID = $newsPageID;

            $n_img = DB::query('select * from news_images where NI_N_ID = ' . $item["N_ID"] . ' limit 1');
            foreach ($n_img as $img) {
                $news_img = trim($img['NI_NAME']);
            }

            $file = new File();
            $file->ClassName = 'Image';
            $file->Name = $news_img;
            $file->Title = preg_replace('/\\.[^.\\s]{3,4}$/', '', $news_img);
            $file->Filename = 'assets/News/' . $news_img;
            $file->ParentID = $newsFolderID;
            $file->OwnerID = 1;
            $file->write();

            $alb->ImageID = $file->ID;
            $alb->write();

        }

        //member/student
        $result = DB::query('SELECT * FROM student where S_ID > 734 ');
        foreach ($result as $row) {

            $gradeID = 0;
            $studentpicID = 0;
            if (!empty($row['S_GRADE'])) {
                $grade = Grade::get()->filter(array('Title' => $row['S_GRADE']))->first();
                if ($grade) {
                    $gradeID = $grade->ID;
                }
            }

            $student_pic = $row['S_PRO_PIC'];

            if (!empty($student_pic)) {
                $file = new File();
                $file->ClassName = 'Image';
                $file->Name = $student_pic;
                $file->Title = preg_replace('/\\.[^.\\s]{3,4}$/', '', $student_pic);
                $file->Filename = 'assets/Students/' . $student_pic;
                $file->ParentID = $studentFolderID;
                $file->OwnerID = 1;
                $file->write();
                $studentpicID = $file->ID;

            }
            $addi_desctip = '<p>';
            $car_acts = explode("\n", $row['S_EXTRA_ACT']);
            foreach ($car_acts as $act) {
                $addi_desctip = $addi_desctip . $act . '<br />';

            }
            $addi_desctip .= '</p>';

            $member = new Member();
            $member->ClassName = 'Member';
            $member->Email = $row['S_AD_ID'];
            $member->FirstName = $row['S_NAME'];
            $member->JoinDate = $row['S_JOIN_DATE'];
            $member->GradeID = $gradeID;
            $member->AdmissionID = $row['S_AD_ID'];
            $member->Contact = $row['S_P_CONTACT'];
            $member->Description = $row['S_DESCRIPTION'] . $addi_desctip;
            $member->changePassword($row['S_AD_ID']);
            $member->ParentEmail = $row['S_P_EMAIL'];
            $member->PhotoID = $studentpicID;
            $member->write();
            $memberID = $member->ID;

            $sports = unserialize($row['S_SPORTS']);

            if (is_array($sports)) {
                foreach ($sports as $sport) {
                    $sportID = 0;
                    $spt = Sport::get()->filter(array('Title' => $sport))->first();
                    if ($spt) {
                        $sportID = $spt->ID;
                    }

                    DB::query('insert into Member_Sports set MemberID=' . $memberID . ', SportID = ' . $sportID);
                }
            }
            $subjects = unserialize($row['S_SUBJECTS']);
            if (is_array($subjects)) {
                foreach ($subjects as $subject) {
                    DB::query('insert into Member_Subjects set MemberID=' . $memberID . ', SubjectID = ' . $subject);
                }
            }
            DB::query('insert into Group_Members set MemberID=' . $memberID . ', GroupID ='.$groupID);
        }

    }

}
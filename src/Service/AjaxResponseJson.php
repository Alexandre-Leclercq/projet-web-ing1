<?php

namespace App\Service;

class AjaxResponseJson {

    private function formatActionCourse($idCourse, $active, $qtyChapter)
    {
        try {
            $action = '<div class="btn-group" role="group" aria-label="Action button">';
            // edit button
            $action .= '<a class="btn btn-sm  btn-primary" href="edit.php?idCourse=' . $idCourse . '" title="Modifier"> 
                                    <span class="icon text-white">
                                        <i class="fas fa-edit"></i> 
                                    </span>
                                </a>&nbsp;';
            // duplicat button
            $action .= '<a class="btn btn-sm  btn-primary" href="edit.php?idCourse=' . $idCourse . '&duplicat" title="Dupliquer"> 
                                <span class="icon text-white">
                                    <i class="fas fa-clone"></i>
                                </span>
                            </a>&nbsp;';
            // see button
            if($qtyChapter <= 0){
                $action .= '<a class="btn btn-sm btn-primary disabled" target="_blank" href="course.php?idCourse=' . $idCourse . '" title="Voir"> 
                            <span class="icon text-white">
                                <i class="fas fa-eye"></i>
                            </span>
                        </a>&nbsp;';
            } else {
                $action .= '<a class="btn btn-sm btn-primary" target="_blank" href="course.php?idCourse=' . $idCourse . '" title="Voir"> 
                            <span class="icon text-white">
                                <i class="fas fa-eye"></i>
                            </span>
                        </a>&nbsp;';
            }
            // add chapter button
            $action .= '<a class="btn btn-sm  btn-primary" title="Ajouter un chapitre" href="editChapter.php?idCourse=' . $idCourse . '"> 
                            <span class="icon text-white">
                                <i class="fas fa-plus"></i>
                            </span>
                        </a>&nbsp;';
            // list chapter button
            $action .= '<a class="btn btn-sm  btn-primary" title="Liste des chapitres" href="listChapter.php?idCourse=' . $idCourse . '"> 
                            <span class="icon text-white">
                                <i class="fas fa-list"></i>
                            </span>
                        </a>&nbsp;';
            if ($active) {
                $action .= '<a class="btn btn-sm  btn-primary activeButton" value="1" title="Actif"> 
                                <span class="icon text-white">
                                    <i class="fas fa-check"></i>
                                </span>
                            </a>&nbsp;';
            } else {
                $action .= '<a class="btn btn-sm  btn-primary activeButton" value="0" title="Actif"> 
                                <span class="icon text-white">
                                    <i class="fas fa-times"></i>
                                </span>
                            </a>&nbsp;';
            }
            return $action;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @var Course[] $courses
     * @return string
     * Return json data for the datatable
     */
    public function listCourseEditor($courses)
    {
        $tmp = [];
        foreach($courses as $course){
            $tmp[] = [
                'id' => $course->getIdCourse(),
                'caption' => $course->getCaption(),
                'category' => is_null($course->getIdCategory()) ? '' : $course->getIdCategory()->getCaption(),
                'qtyChapter' => $course->getQtyChapter(),
                'action' => $this->formatActionCourse($course->getIdCourse(), $course->getActive(), 0)
            ];
        }
        return json_encode($tmp);
    }
}

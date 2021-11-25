<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AjaxResponseJson
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    private function formatActionCourse($idCourse, $active, $qtyChapter)
    {
        try {
            $listChapter = $this->router->generate('editor.chapter.list', ['idCourse' => $idCourse]);
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
            if ($qtyChapter <= 0) {
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
            $action .= '<a class="btn btn-sm  btn-primary" title="Liste des chapitres" href="' . $listChapter . '"> 
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
    public function listCourseEditor($courses): array
    {
        $tmp = [];
        foreach ($courses as $course) {
            $tmp[] = [
                'id' => $course['course']->getIdCourse(),
                'caption' => $course['course']->getCaption(),
                'category' => is_null($course['course']->getIdCategory()) ? '' : $course['course']->getIdCategory()->getCaption(),
                'qtyChapter' => $course['qtyChapter'],
                'action' => $this->formatActionCourse($course['course']->getIdCourse(), $course['course']->getActive(), $course['qtyChapter'])
            ];
        }
        return $tmp;
    }

        /**
     * @var Chapter[] $chapters
     * @return string
     * Return json data for the datatable
     */
    public function listChapterEditor($chapter): array
    {

    }
}

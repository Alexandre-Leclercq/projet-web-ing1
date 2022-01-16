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
    /**
     * @param int $idUser
     * @param int $active
     * Create the button for the datatable user
     */
    private function formatActionUser($idUser, $active): string
    {
        try {
            $action = '<div class="btn-group" role="group" aria-label="Action button">';
            // edit button
            $action .= '<a class="btn btn-sm  btn-primary" href="' . $this->router->generate('admin.user.edit', ['id' => $idUser]) . '" title="Modifier"> 
                                    <span class="icon text-white">
                                        <i class="fas fa-edit"></i> 
                                    </span>
                                </a>&nbsp;';
            if ($active) {
                $action .= '<a class="btn btn-sm  btn-primary activeButton" value="1" title="Actif"> 
                                <span class="icon text-white">
                                    <i class="fas fa-check"></i>
                                </span>
                            </a>&nbsp;';
            } else {
                $action .= '<a class="btn btn-sm  btn-danger activeButton" value="0" title="Actif"> 
                                <span class="icon text-white">
                                    <i class="fas fa-times"></i>
                                </span>
                            </a>&nbsp;</div>';
            }
            return $action;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param User[] $users
     * @return array
     * Create the array that contains the informations about users
     */
    public function listUserEditor($users): array
    {
        try {

            $tmp = [];
            foreach ($users as $user) {
                $tmp[] = [
                    'id' => $user->getIdUser(),
                    'name' => $user->getFirstName() . ' ' . $user->getLastName(),
                    'role' =>  '<span class="badge rounded-pill bg-' . $user->getIdRole()->getColor() . '">' . $user->getIdRole()->getExternCaption() . '</span>',
                    'dateLog' => is_null($user->getDateLog()) ? '' : $user->getDateLog()->format('d/m/Y H:i:s'),
                    'action' => $this->formatActionUser($user->getIdUser(), $user->getActive()),
                ];
            }
            return $tmp;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param int $idCourse
     * @param int $active
     * @param int $qtyChapter
     * @return string
     * Create the button for the datatable course
     */
    private function formatActionCourse($idCourse, $active, $qtyChapter): string
    {
        try {
            $action = '<div class="btn-group" role="group" aria-label="Action button">';
            // edit button
            $action .= '<a class="btn btn-sm  btn-primary" href="' . $this->router->generate('editor.course.edit', ['id' => $idCourse]) . '" title="Modifier"> 
                                    <span class="icon text-white">
                                        <i class="fas fa-edit"></i> 
                                    </span>
                                </a>&nbsp;';
            // duplicat button
            $action .= '<a class="btn btn-sm  btn-primary" href="' . $this->router->generate('editor.course.duplicate', ['id' => $idCourse]) . '" title="Dupliquer"> 
                                <span class="icon text-white">
                                    <i class="fas fa-clone"></i>
                                </span>
                            </a>&nbsp;';
            // see button
            if ($qtyChapter <= 0) {
                $action .= '<a class="btn btn-sm btn-primary disabled" target="_blank" href="' . $this->router->generate('user.course.content', ['course' => $idCourse]) . '" title="Voir"> 
                            <span class="icon text-white">
                                <i class="fas fa-eye"></i>
                            </span>
                        </a>&nbsp;';
            } else {
                $action .= '<a class="btn btn-sm btn-primary" target="_blank" href="' . $this->router->generate('user.course.content', ['course' => $idCourse]) . '" title="Voir"> 
                            <span class="icon text-white">
                                <i class="fas fa-eye"></i>
                            </span>
                        </a>&nbsp;';
            }
            // add chapter button
            $action .= '<a class="btn btn-sm  btn-primary" title="Ajouter un chapitre" href="' . $this->router->generate('editor.chapter.add', ['id' => $idCourse]) . '"> 
                            <span class="icon text-white">
                                <i class="fas fa-plus"></i>
                            </span>
                        </a>&nbsp;';
            // list chapter button
            $action .= '<a class="btn btn-sm  btn-primary" title="Liste des chapitres" href="' . $this->router->generate('editor.chapter.list', ['idCourse' => $idCourse]) . '"> 
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
                $action .= '<a class="btn btn-sm  btn-danger activeButton" value="0" title="Actif"> 
                                <span class="icon text-white">
                                    <i class="fas fa-times"></i>
                                </span>
                            </a>&nbsp;</div>';
            }
            return $action;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param Course[] $courses
     * @return array
     * Create the array that contains the informations about courses
     */
    public function listCourseEditor($courses): array
    {
        try {
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
        } catch (\Exception $e) {
            [];
        }
    }

    /**
     * @param Course $idCourse
     * @param int $active
     * @param int $idChapter
     * @param int $step
     * @return string
     * Create the button for the datatable chapter
     */
    function formatActionChapter($active, $idChapter, $idCourse, $step): string
    {
        try {
            $action = '<div class="btn-group" role="group" aria-label="Action button">';
            // edit button
            $action .= '<a class="btn btn-sm  btn-primary" href="' . $this->router->generate('editor.chapter.edit', ['id' => $idChapter]) . '" title="Modifier"> 
                                <span class="icon text-white">
                                    <i class="fas fa-edit"></i> 
                                </span>
                            </a>&nbsp;';
            // duplicat button
            $action .= '<a class="btn btn-sm  btn-primary" href="' . $this->router->generate('editor.chapter.duplicate', ['id' => $idChapter]) . '&duplicat" title="Dupliquer"> 
                            <span class="icon text-white">
                                <i class="fas fa-clone"></i>
                            </span>
                        </a>&nbsp;';
            $action .= '<a class="btn btn-sm btn-primary" target="_blank" href="' . $this->router->generate('user.course.content', ['course' => $idCourse->getIdCourse(), 'step' => $step]) . '" title="Voir"> 
            <span class="icon text-white">
                <i class="fas fa-eye"></i>
            </span>
        </a>&nbsp;';
            if ($active) {
                $action .= '<a class="btn btn-sm  btn-primary activeButton" value="1" title="Actif"> 
                            <span class="icon text-white">
                                <i class="fas fa-check"></i>
                            </span>
                        </a>&nbsp;</div>';
            } else {
                $action .= '<a class="btn btn-sm  btn-danger activeButton" value="0" title="Actif"> 
                            <span class="icon text-white">
                                <i class="fas fa-times"></i>
                            </span>
                        </a>&nbsp;</div>';
            }
            return $action;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Chapter[] $chapters
     * @return array
     * Create the array that contains the informations about chapters
     */
    public function listChapterEditor($chapters): array
    {
        try {
            $tmp = [];
            foreach ($chapters as $chapter) {
                $tmp[] = [
                    'id' => $chapter->getIdChapter(),
                    'caption' => $chapter->getCaption(),
                    'step' => $chapter->getStep(),
                    'action' => $this->formatActionChapter($chapter->getActive(), $chapter->getIdChapter(), $chapter->getIdCourse(), $chapter->getStep())
                ];
            }
            return $tmp;
        } catch (\Exception $e) {
            [];
        }
    }
}

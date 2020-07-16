<?php


namespace Maksimovichd\Observer;


use SplObserver;
use SplSubject;

/**
 * Class Observer
 * @package Observer
 */
abstract class Observer implements SplObserver
{
    /**
     * @todo расширить за счет добавления бизнес-логики
     */

    /**
     * Observer constructor.
     */
    public function __construct(){}

    /**
     * Получает обновления от субъекта
     * @param SplSubject $subject
     */
    abstract public function update(SplSubject $subject): void;
}

<?php


namespace Maksimovichd\Observer;


use SplObserver;
use SplSubject;

/**
 * Class Subject
 * @package Observer
 */
class Subject implements SplSubject
{
    /**
     * @var array
     */
    private array $observers = [];

    /**
     * Subject constructor.
     */
    public function __construct()
    {
        $this->observers['*'] = [];
    }

    /**
     * @param string $event
     */
    private function initEventGroup(string $event = '*'): void
    {
        if (!isset($this->observers[$event])) {
            $this->observers[$event] = [];
        }
    }

    /**
     * @param string $event
     * @return array
     */
    private function getEventObservers(string $event = '*'): array
    {
        $this->initEventGroup($event);
        $group = $this->observers[$event];
        $all = $this->observers['*'];

        return array_merge($group, $all);
    }

    /**
     * Присоединяет наблюдателя
     * @param SplObserver $observer
     * @param string $event
     */
    public function attach(SplObserver $observer, string $event = '*'): void
    {
        $this->initEventGroup($event);
        $this->observers[$event][] = $observer;
    }

    /**
     * Отсоединяет наблюдателя
     * @param SplObserver $observer
     * @param string $event
     */
    public function detach(SplObserver $observer, string $event = '*'): void
    {
        foreach ($this->getEventObservers($event) as $key => $s) {
            if ($s === $observer) {
                unset($this->observers[$event][$key]);
            }
        }
    }

    /**
     * Уведомляет наблюдателя
     * @param string $event
     * @param null $data
     */
    public function notify(string $event = '*', $data = null): void
    {
        foreach ($this->getEventObservers($event) as $observer) {
            $observer->update($this, $event, $data);
        }
    }

    /**
     * @todo расширить за счет добавления бизнес-логики
     */
}

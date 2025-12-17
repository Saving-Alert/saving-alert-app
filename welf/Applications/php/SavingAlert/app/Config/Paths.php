<?php

namespace Config;

class Paths
{
    /**
     * System Directory
     */
    public string $systemDirectory = __DIR__ . '/../../system';

    /**
     * App Directory
     */
    public string $appDirectory = __DIR__ . '/..';

    /**
     * Writable Directory
     */
    public string $writableDirectory = __DIR__ . '/../../writable';

    /**
     * Tests Directory
     */
    public string $testsDirectory = __DIR__ . '/../../tests';

    /**
     * View Directory
     */
    public string $viewDirectory = __DIR__ . '/../Views';
}

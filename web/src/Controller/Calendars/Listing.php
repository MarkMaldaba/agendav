<?php

namespace AgenDAV\Controller\Calendars;

/*
 * Copyright 2015 Jorge López Pérez <jorge@adobo.org>
 *
 *  This file is part of AgenDAV.
 *
 *  AgenDAV is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  AgenDAV is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with AgenDAV.  If not, see <http://www.gnu.org/licenses/>.
 */

use AgenDAV\Controller\JSONController;
use AgenDAV\CalDAV\Resource\Calendar;
use AgenDAV\Data\Transformer\CalendarTransformer;
use League\Fractal\Resource\Collection;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;

class Listing extends JSONController
{
    public function execute(array $input, Application $app)
    {
        $calendars = $app['calendar.finder']->getCalendars();

        $fractal = $app['fractal'];
        $collection = new Collection($calendars, new CalendarTransformer, 'calendars');

        return new JsonResponse($fractal->createData($collection)->toArray());
    }

}

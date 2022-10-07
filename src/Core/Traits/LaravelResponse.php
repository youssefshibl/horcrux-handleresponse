<?php

namespace Horcrux\Handleresponse\Core\Traits;

use ErrorException;
use Exception;
use League\Flysystem\Adapter\NullAdapter;

trait LaravelResponse
{
    // send error method

    protected $driver = '';
    protected $driver_defined = false;
    protected $status_code_value = 200;

    public  function senderror($data = [], $status_code = null,  string $driver = '')
    {
        // check driver
        if (!$this->driver_defined) {
            $this->check_driver($driver);
        }
        // get data schema
        $data_finished = $this->get_schema($data, false, 'reset_error');


        if ($this->check_status_code($status_code)) {
            return response()->json($data_finished, $this->status_code_value);
        } else {
            return response()->json($data_finished);
        }
    }
    public function senddata($data = [], $status_code = null,  string $driver = '')
    {
        // check driver
        if (!$this->driver_defined) {
            $this->check_driver($driver);
        }
        // get data schema
        $data_finished = $this->get_schema($data, true, 'reset_success');

        if ($this->check_status_code($status_code)) {
            return response()->json($data_finished, $this->status_code_value);
        } else {
            return response()->json($data_finished);
        }
    }
    public function sendsuccess($driver = '')
    {
        if (!$this->driver_defined) {
            $this->check_driver($driver);
        }
        $driver_key_status = config('horcruxresponse.drivers.' . $this->driver . '.status_key');
        return response()->json([
            $driver_key_status => true
        ], $this->status_code_value);
    }
    protected function get_schema($data = [], $key_statues, $reset_name)
    {
        $driver_reset_array = config('horcruxresponse.drivers.' . $this->driver . '.' . $reset_name);
        $driver_key_status = config('horcruxresponse.drivers.' . $this->driver . '.status_key');
        $count_reset = count($driver_reset_array);
        $schema = [
            $driver_key_status => $key_statues
        ];
        for ($i = 0; $i < $count_reset; $i++) {
            $schema[$driver_reset_array[$i]] = $data[$i];
        }
        return $schema;
    }
    protected function check_driver($driver)
    {
        if ($driver == '' || $driver == config('horcruxresponse.default_dirver')) {
            $this->driver = config('horcruxresponse.default_dirver');
        } else {
            $drivers_array = config('horcruxresponse.drivers');

            if (array_key_exists($driver, $drivers_array)) {
                $this->driver = $driver;
            } else {
                throw new ErrorException('this driver "' . $driver . '" is not found in horcruxresponse.php in config file ');
            }
        }
    }
    public function change_driver($driver)
    {
        $this->driver_defined = true;
        $this->check_driver($driver);
    }
    protected function check_status_code($status = 200)
    {
        if (!config('horcruxresponse.withstatus')) {
            return false;
        } else {
            if ($status != null && is_integer($status)) {
                $this->status_code_value = $status;
            }
            return true;
        }
    }
}

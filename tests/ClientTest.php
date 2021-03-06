<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function testGetId()
        {
            //Arrange
            $name = "Bob";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $client_name = "Gertrude";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id, $id);
            $test_client->save();

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testUpdate()
        {
            //Arrange
            $name = "Bob";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $client_name = "Gertrude";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id, $id);
            $test_client->save();

            $new_client_name = "Billy";

            //Act
            $test_client->update($new_client_name);

            //Assert
            $this->assertEquals("Billy", $test_client->getName());
        }

        function testGetStylistId()
        {
            //Arrange
            $name = "Bob";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $client_name = "Gertrude";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id, $id);
            $test_client->save();

            //Act
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testSave()
        {
            //Arrange
            $name = "Bob";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $client_name = "Gertrude";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id, $id);

            //Act
            $test_client->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals($test_client, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Bob";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $stylist_id = $test_stylist->getId();

            $client_name = "Berta";
            $test_client = new Client($client_name, $stylist_id, $id);
            $test_client->save();

            $client_name2 = "Gertrude";
            $test_client2 = new Client($client_name2, $stylist_id, $id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Bob";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $stylist_id = $test_stylist->getId();

            $client_name = "Berta";
            $test_client = new Client($client_name, $stylist_id, $id);
            $test_client->save();

            $client_name2 = "Gertrude";
            $test_client2 = new Client($client_name2, $stylist_id, $id);
            $test_client2->save();

            //Assert
            Client::deleteAll();

            //Assert
            $result = Client::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $name = "Bob";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $stylist_id = $test_stylist->getId();

            $client_name = "Berta";
            $test_client = new Client($client_name, $stylist_id, $id);
            $test_client->save();

            $client_name2 = "Gertrude";
            $test_client2 = new Client($client_name2, $stylist_id, $id);
            $test_client2->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);
        }


    }

?>

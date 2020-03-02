<?php

    class adminModule {

        public function method_options() {

            $settings = new settings();

            if (isset($this->methodData->submit)) {
                $settings->update("facebookAppID", $this->methodData->facebookAppID);
                $settings->update("facebookLoginURL", $this->methodData->facebookLoginURL);
                $settings->update("facebookSecret", $this->methodData->facebookSecret);
                $this->html .= $this->page->buildElement("success", array(
                    "text" => "Options updated."
                ));
            }

            $output = array(
                "ranks" => $this->db->selectAll("
                    SELECT R_id as 'id', R_name as 'name' 
                    FROM ranks ORDER BY R_exp ASC
                "),
                "facebookAppID" => $settings->loadSetting("facebookAppID"),
                "facebookLoginURL" => $settings->loadSetting("facebookLoginURL"),
                "facebookSecret" => $settings->loadSetting("facebookSecret")
            );

            $this->html .= $this->page->buildElement("options", $output);

        }

    }
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ADMIN_MODELS extends CI_Model
{
    public static $smssql = null;
    public $dbsql = null;
    private static $sPRIMARY_KEY = "AD_ID";
    public static $sTABLE_NAME = "admin";


    public function __construct()
    {
        parent::__construct();
        $this->dbsql = $this->load->database('MYSQL', TRUE);
        self::$smssql = $this->load->database('MYSQL', TRUE);

    }



    public static function TB_NAME()
    {
        return sprintf("%s", self::$sTABLE_NAME);
    }

    public static function LastID()
    {

        $temp = new stdClass();

        self::$smssql->select(sprintf("MAX(%s.%s) AS MAX_ID", self::TB_NAME(), self::$sPRIMARY_KEY));
        self::$smssql->from(sprintf("%s as %s", self::TB_NAME(), self::TB_NAME()));

        $query = self::$smssql->get();

        $temp = $query->row_object();
        if ($temp !== null) {
            if ($temp->MAX_ID == null)
                return 0;
            else
                return $temp->MAX_ID;
        } else {
            return 0;
        }
    }

    public static function InsertResources($data)
    {

        if ($data !== NULL) {
            self::$smssql->insert(self::TB_NAME(), $data);
            return self::$smssql->insert_id();
        } else {
            return false;
        }
    }

    public static function UpdateResources($temp_data = array())
    {
        // global $mssqlG;
        $example = [
            "WHERE" => [
                "key" => "VALUE"
            ],
            "DATA" => [
                "key" => "VALUE",
            ],
            "TABLE" => self::TB_NAME()
        ];
        $temp_data = (object) $temp_data;



        $WHERE = isset($temp_data->WHERE) ? $temp_data->WHERE : array();
        $DATA = isset($temp_data->DATA) ? $temp_data->DATA : array();
        $TABLE = isset($temp_data->TABLE) ? $temp_data->TABLE : self::TB_NAME();

        if (!empty($WHERE)) {
            foreach ($WHERE as $key_WHERE => $item_WHERE):
                self::$smssql->where(sprintf("%s", $key_WHERE), $item_WHERE);
            endforeach;
        }

        if (!empty($DATA)) {
            foreach ($DATA as $key_DATA => $item_DATA):
                self::$smssql->set(sprintf("%s", $key_DATA), $item_DATA);
            endforeach;
        }


        if (!empty($TABLE && !empty($DATA))) {

            try {
                self::$smssql->update($TABLE);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        return false;
    }

    public static function DeleteResources($temp_data)
    {
        $ex = [
            "TABLE" => 'TABLE_NAME',
            "WHERE" => [
                "COLUMN_NAME" => "value",
            ]
        ];

        if (empty($temp_data)) {
            return false;
        } else {
            $temp_data = (object) $temp_data;
        }


        try {
            $WHERE = isset($temp_data->WHERE) ? $temp_data->WHERE : array();
            $TABLE = isset($temp_data->TABLE) ? $temp_data->TABLE : self::TB_NAME();
            if (!empty($WHERE)) {
                foreach ($WHERE as $ki => $ii):
                    self::$smssql->where($ki, $ii);
                endforeach;
            }
            self::$smssql->delete($TABLE);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


	public function QueryResources($temp_data = array())
	{
		$examp = [
			"JOIN" => [
				"TABLE_NAME" => [
					"ON" => "FORM_RUNNO",
					"TYPE" => "INNER/LEFT/RIGHT/FULL",
					"JOIN" => NULL,
					"KEY_JOIN" => NULL,
				]
			],
			"GROUP_BY" => [
				"TABLE_NAME" => ["VALUE"]
			],
			"SELECT" => [
				"TABLE_NAME" => ["VALUE"]
			],
			"WHERE" => [
				"TABLE_NAME" => [
					"COLUMN_NAME" => "VALUE",
					"COLUMN_NAMES" => [
						"DATA" => "VALUE",
						"CONDITION" => "and/or/in/or_in/not_in/or_not_in/LIKE/OR_LIKE",
						"GROUP" => TRUE || FALSE,
					],

					"GROUPS_1-10" => [
						"GROUP_AND" => "OR || AND",

						"GROUP_1-10" => [
							"GROUP_AND" => "OR || AND",
							"COLUMN_NAME" => [
								"DATA" => "NULL" || NULL || "string" || "array",
								"CONDITION" => "and/or/in/or_in/not_in/or_not_in/LIKE/OR_LIKE",
							],
						],

						"COLUMN_NAME" => [
							"DATA" => "VALUE" || ["VALUE"],
							"CONDITION" => "and/or/in/or_in/not_in/or_not_in/LIKE/OR_LIKE",
							"GROUP" => TRUE || FALSE,
						],
					],

				],
				"CUSTOMS" => "SQL TEXT" || ["SQL TEXT"],
			],
			"ORDER_BY" => [
				"TABLE_NAME" => [
					"KET" => "DESC||ASC"
				]
			],
			"TYPE_RESULT" => "object||array",
			"ONE_ROW" => false || TRUE,
			"TABLE_NAME" => self::TB_NAME()
		];



		$temp = array();
		$JOIN = array();
		$GROUP_BY = array();
		$SELECT = array();
		$WHERE = array();
		$ORDER_BY = array();
		$TYPE_RESULT = 'object';
		$ONE_ROW = false;
		$TABLE_NAME = self::TB_NAME();


		if (empty($temp_data)) {
			$this->mssql->from(self::TB_NAME());
			$query = $this->mssql->get();
			$temp = $query->result_object();
			return $temp;
		} else {
			$temp_data = (object) $temp_data;
		}



		$JOIN = isset($temp_data->JOIN) ? $temp_data->JOIN : array();
		$GROUP_BY = isset($temp_data->GROUP_BY) ? $temp_data->GROUP_BY : array();
		$SELECT = isset($temp_data->SELECT) ? $temp_data->SELECT : array();
		$WHERE = isset($temp_data->WHERE) ? $temp_data->WHERE : array();
		$ORDER_BY = isset($temp_data->ORDER_BY) ? $temp_data->ORDER_BY : array();
		$TYPE_RESULT = isset($temp_data->TYPE_RESULT) ? $temp_data->TYPE_RESULT : 'object';
		$ONE_ROW = isset($temp_data->ONE_ROW) ? $temp_data->ONE_ROW : false;
		$TABLE_NAME = isset($temp_data->TABLE_NAME) ? $temp_data->TABLE_NAME : self::TB_NAME();

		$this->mssql->from($TABLE_NAME);

		if (!empty($WHERE)) {
			foreach ($WHERE as $key_WHERE => $item_WHERE):

				if ($key_WHERE == "CUSTOMS") {
					if (gettype($item_WHERE) == "array") {
						foreach ($item_WHERE as $item) {
							$this->mssql->where($item);
						}
					}

					if (gettype($item_WHERE) == "string") {
						$this->mssql->where($item_WHERE);
					}

					continue;
				}

				if (gettype($item_WHERE) == 'array') {

					foreach ($item_WHERE as $key_item_WHERE => $item_item_WHERE):
						if ($key_item_WHERE !== 0) {

							$TB_ = $key_WHERE;
							$KE_ = $key_item_WHERE;

							if ($key_item_WHERE == 'GROUPS_1' || $key_item_WHERE == 'GROUPS_2' || $key_item_WHERE == 'GROUPS_3' || $key_item_WHERE == 'GROUPS_4' || $key_item_WHERE == 'GROUPS_5' || $key_item_WHERE == 'GROUPS_6' || $key_item_WHERE == 'GROUPS_7' || $key_item_WHERE == 'GROUPS_8' || $key_item_WHERE == 'GROUPS_9' || $key_item_WHERE == 'GROUPS_10') {

								if ($item_item_WHERE !== null) {

									if (isset($item_item_WHERE['GROUP_AND'])) {
										if ($item_item_WHERE['GROUP_AND'] == 'AND') {
											$this->mssql->group_start();
										} else {
											$this->mssql->or_group_start();
										}
									} else {
										$this->mssql->group_start();
									}



									foreach ($item_item_WHERE as $dki => $dii):


										if ($dki === 'GROUP_AND') {
											continue;
										}



										if ($dki === 'GROUP_1' || $dki === 'GROUP_2' || $dki === 'GROUP_3' || $dki === 'GROUP_4' || $dki === 'GROUP_5') {


											if (isset($dii['GROUP_AND'])) {
												if ($dii['GROUP_AND'] == 'AND') {
													$this->mssql->group_start();
												} else if ($dii['GROUP_AND'] == 'OR') {
													$this->mssql->or_group_start();
												}
											} else {
												$this->mssql->group_start();
											}

											$temp = array();

											foreach ($dii as $kgroupi => $kgroupii):

												$DGS_COL = $kgroupi;
												$DGS_DATA = isset($kgroupii['DATA']) ? $kgroupii['DATA'] : array();
												$DGS_CONDITION = strtoupper(isset($kgroupii['CONDITION']) ? $kgroupii['CONDITION'] : 'and');
												$DGSGROUP = isset($kgroupii['GROUP_AND']) ? $kgroupii['GROUP_AND'] : NULL;


												if ($kgroupi === 'GROUP_AND') {
													continue;
												}


												if (empty($DGS_DATA)) {
													continue;
												}

												// return  $kgroupii;
												$DGS_DATA = $DGS_DATA === 'NULL' ? NULL : $DGS_DATA;



												if ($DGSGROUP == 'AND') {
													$this->mssql->group_start();
												} else if ($DGSGROUP == 'OR') {
													$this->mssql->or_group_start();
												}


												switch ($DGS_CONDITION) {

													case 'AND':
														if (gettype($DGS_DATA) == "array") {

															foreach ($DGS_DATA as $DGSKI => $DGSII):
																$this->mssql->where(sprintf("%s.%s", $TB_, $DGS_COL), $DGSII, FALSE);
															endforeach;
														} else {

															$this->mssql->where(sprintf("%s.%s", $TB_, $DGS_COL), $DGS_DATA);
														}
														break;
												}


												if (isset($DGSGROUP)) {
													$this->mssql->group_end();
												}

											endforeach;


											$this->mssql->group_end();
											continue;
										}


										$D_COL = $dki;
										$D_DATA = isset($dii['DATA']) ? $dii['DATA'] : array();
										$D_CONDITION = strtoupper(isset($dii['CONDITION']) ? $dii['CONDITION'] : 'and');
										$GROUP = isset($dii['GROUP']) ? $dii['GROUP'] : false;


										if (empty($D_DATA)) {
											continue;
										}

										$D_DATA = $D_DATA === 'NULL' ? NULL : $D_DATA;

										// return $D_DATA;
										switch ($D_CONDITION) {
											case 'OR_LIKE':
												if (gettype($D_DATA) == "array") {
													if ($GROUP == true) {
														$this->mssql->group_start();
													}


													foreach ($D_DATA as $key_DK => $item_DK):
														$this->mssql->or_like(sprintf("%s.%s", $TB_, $D_COL), $item_DK, 'both');
													endforeach;

													if ($GROUP == true) {
														$this->mssql->group_end();
													}
												} else {
													$this->mssql->or_like(sprintf("%s.%s", $TB_, $D_COL), $D_DATA, 'both');
												}
												break;
											case 'AND':
												// $this->mssql->where(sprintf('%s.%s = %s', $TB_, $D_COL), $D_DATA, FALSE);
												if (gettype($D_DATA) == "array") {
													if ($GROUP == true) {
														$this->mssql->group_start();
													}
													foreach ($D_DATA as $key_DK => $item_DK):
														$this->mssql->where(sprintf("%s.%s", $TB_, $D_COL), $item_DK, FALSE);
													endforeach;
													if ($GROUP == true) {
														$this->mssql->group_end();
													}
												} else {
													// $this->mssql->where();
													$this->mssql->where(sprintf("%s.%s", $TB_, $D_COL), $D_DATA);
												}
												break;
											case 'OR':
												// $this->mssql->where(sprintf('%s.%s = %s', $TB_, $D_COL), $D_DATA, FALSE);
												if (gettype($D_DATA) == "array") {
													if ($GROUP == true) {
														$this->mssql->group_start();
													}
													foreach ($D_DATA as $key_DK => $item_DK):
														$this->mssql->or_where(sprintf("%s.%s", $TB_, $D_COL), $item_DK, FALSE);
													endforeach;
													if ($GROUP == true) {
														$this->mssql->group_end();
													}
												} else {
													// $this->mssql->where();
													$this->mssql->or_where(sprintf("%s.%s", $TB_, $D_COL), $D_DATA);
												}
												break;
										}

									endforeach;

									$this->mssql->group_end();
								}

								continue;
							}

							if (gettype($item_item_WHERE) == "array") {

								$item_item_WHERE = (object) $item_item_WHERE;
								$item_item_WHERE_array = $item_item_WHERE;

								$CONDITION = strtoupper(isset($item_item_WHERE->CONDITION) ? $item_item_WHERE->CONDITION : 'and');
								$DATA_K = isset($item_item_WHERE->DATA) ? $item_item_WHERE->DATA : array();
								$GROUP = isset($item_item_WHERE->GROUP) ? $item_item_WHERE->GROUP : false;

								if (empty($DATA_K)) {
									continue;
								}

								switch ($CONDITION) {
									case 'OR':
										if (gettype($DATA_K) == "array") {
											if ($GROUP == true) {
												$this->mssql->group_start();
											}
											foreach ($DATA_K as $key_DK => $item_DK):
												$this->mssql->or_where(sprintf("%s.%s", $TB_, $KE_), $item_DK);
											endforeach;
											if ($GROUP == true) {
												$this->mssql->group_end();
											}
										} else {
											$this->mssql->or_where(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
										}
										break;
									case 'IN':
										if (gettype($DATA_K) == "array") {

											if ($GROUP == true) {
												$this->mssql->group_start();
											}
											$this->mssql->where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
											if ($GROUP == true) {
												$this->mssql->group_end();
											}
										} else {
											$this->mssql->where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
										}

										break;
									case 'OR_IN':
										if (gettype($DATA_K) == "array") {
											if ($GROUP == true) {
												$this->mssql->group_start();
											}
											$this->mssql->or_where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
											if ($GROUP == true) {
												$this->mssql->group_end();
											}
										} else {
											$this->mssql->or_where_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
										}
										break;
									case 'NOT_IN':
										if (gettype($DATA_K) == "array") {
											if ($GROUP == true) {
												$this->mssql->group_start();
											}
											$this->mssql->where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);

											if ($GROUP == true) {
												$this->mssql->group_end();
											}
										} else {
											$this->mssql->where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
										}

										break;
									case 'OR_NOT_IN':
										if (gettype($DATA_K) == "array") {
											if ($GROUP == true) {
												$this->mssql->group_start();
											}
											$this->mssql->where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);

											if ($GROUP == true) {
												$this->mssql->group_end();
											}
										} else {
											$this->mssql->or_where_not_in(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
										}
										break;
									case 'AND':
										if (gettype($DATA_K) == "array") {
											if ($GROUP == true) {
												$this->mssql->group_start();
											}
											foreach ($DATA_K as $key_DK => $item_DK):
												$this->mssql->where(sprintf("%s.%s", $TB_, $KE_), $item_DK);
											endforeach;
											if ($GROUP == true) {
												$this->mssql->group_end();
											}
										} else {
											$this->mssql->where(sprintf("%s.%s", $TB_, $KE_), $DATA_K);
										}
										break;
									case 'LIKE':
										if (gettype($DATA_K) == "array") {
											if ($GROUP == true) {
												$this->mssql->group_start();
											}
											foreach ($DATA_K as $key_DK => $item_DK):
												$this->mssql->like(sprintf("%s.%s", $TB_, $KE_), $item_DK, 'both');
											endforeach;
											if ($GROUP == true) {
												$this->mssql->group_end();
											}
										} else {
											$this->mssql->like(sprintf("%s.%s", $TB_, $KE_), $DATA_K, 'both');
										}
										break;
									case 'OR_LIKE':
										if (gettype($DATA_K) == "array") {
											if ($GROUP == true) {
												$this->mssql->group_start();
											}
											foreach ($DATA_K as $key_DK => $item_DK):
												$this->mssql->or_like(sprintf("%s.%s", $TB_, $KE_), $item_DK, 'both');
											endforeach;
											if ($GROUP == true) {
												$this->mssql->group_end();
											}
										} else {
											$this->mssql->or_like(sprintf("%s.%s", $TB_, $KE_), $DATA_K, 'both');
										}
										break;
								}
							} else {
								$this->mssql->where(sprintf("%s.%s", $TB_, $KE_), $item_item_WHERE);
							}
						}
					endforeach;
				}
			endforeach;
		}


		if (!empty($SELECT)) {
			$count_select = 0;
			$temp_SELECT = '';
			foreach ($SELECT as $key_seletct => $item_seletct):
				$temp_SELECT .= $count_select == 0 ? ' ' : ",";
				foreach ($item_seletct as $key_item_seletct => $item_item_seletct):
					$temp_SELECT .= $key_item_seletct == 0 ? ' ' : ",";
					$temp_SELECT .= " " . $key_seletct . '.' . $item_item_seletct . ' ';
				endforeach;
				$count_select++;
			endforeach;
			$this->mssql->select($temp_SELECT);
		}

		if (!empty($GROUP_BY)) {
			$temp_GROUP = '';
			$count_group = 0;
			foreach ($GROUP_BY as $key_group => $item_group):
				$temp_GROUP .= $count_group == 0 ? ' ' : ",";
				foreach ($item_group as $key_item_group => $item_item_group):
					$temp_GROUP .= $key_item_group == 0 ? '' : ",";
					$temp_GROUP .= "$key_group" . '.' . $item_item_group . ' ';
				endforeach;
				$count_group++;
			endforeach;
			if (empty($SELECT)) {
				$this->mssql->select($temp_GROUP);
			}
			$this->mssql->group_by($temp_GROUP);
		}


		if (empty($SELECT) && empty($GROUP_BY)) {
			$this->mssql->select("*");
		}


		if (!empty($JOIN)) {
			foreach ($JOIN as $key => $item):
				$TBL_JOIN = $key;
				$ON = isset($item['ON']) ? $item['ON'] : self::$sPRIMARY_KEY;
				$JOIN = isset($item['JOIN']) ? $item['JOIN'] : $TABLE_NAME;
				$KEY_JOIN = isset($item['KEY_JOIN']) ? $item['KEY_JOIN'] : $ON;
				$TYPE = isset($item['TYPE']) ? $item['TYPE'] : 'INNER';

				$this->mssql->join($TBL_JOIN, "{$JOIN}.{$KEY_JOIN} = {$TBL_JOIN}.{$ON}  ", "{$TYPE}");
			endforeach;
		}

		if (!empty($ORDER_BY)) {
			foreach ($ORDER_BY as $key_ORDER_BY => $item_ORDER_BY):
				$TBL_ = $key_ORDER_BY;
				foreach ($item_ORDER_BY as $key_item_ORDER_BY => $item_item_ORDER_BY):
					$this->mssql->order_by("{$TBL_}.{$key_item_ORDER_BY}", $item_item_ORDER_BY);
				endforeach;
			endforeach;
		}


		try {
			$query = $this->mssql->get();

			if ($TYPE_RESULT == 'object' && $ONE_ROW != true) {
				$temp = $query->result_object();
			} elseif ($TYPE_RESULT == 'array' && $ONE_ROW != true) {
				$temp = $query->result_array();
			} elseif ($TYPE_RESULT == 'object' && $ONE_ROW == true) {
				$temp = $query->row_object();
			} elseif ($TYPE_RESULT == 'array' && $ONE_ROW == true) {
				$temp = $query->row_array();
			} else {
				$temp = $query->result_object();
			}

			return $temp;
		} catch (Exception $e) {
			return $e;
			// return $temp;
		}
	}

}

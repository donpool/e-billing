<?php

/**
 * This is the model class for table "Usuarios".
 *
 * The followings are the available columns in table 'Usuarios':
 * @property integer $usr_codigo
 * @property string $usr_nombre
 * @property string $usr_ruc
 * @property string $usr_password
 * @property string $usr_emal
 * @property string $usr_direccion
 * @property integer $usr_estado
 * @property string $usr_fecadd
 * @property string $usr_fecupd
 */
class Usuarios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usr_nombre, usr_ruc, usr_password', 'required'),
			array('usr_estado', 'numerical', 'integerOnly'=>true),
			array('usr_nombre', 'length', 'max'=>500),
			array('usr_ruc', 'length', 'max'=>20),
			array('usr_password', 'length', 'max'=>100),
			array('usr_emal', 'length', 'max'=>200),
			array('usr_direccion, usr_fecupd', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('usr_codigo, usr_nombre, usr_ruc, usr_password, usr_emal, usr_direccion, usr_estado, usr_fecadd, usr_fecupd', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usr_codigo' => 'Codigo',
			'usr_nombre' => 'Nombre',
			'usr_ruc' => 'RUC',
			'usr_password' => 'Password',
			'usr_emal' => 'E-mail',
			'usr_direccion' => 'Direccion',
			'usr_estado' => 'Estado',
			'usr_fecadd' => 'Fecha de Ingreso',
			'usr_fecupd' => 'Fecha de Modificacion',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('usr_codigo',$this->usr_codigo);
		$criteria->compare('usr_nombre',$this->usr_nombre,true);
		$criteria->compare('usr_ruc',$this->usr_ruc,true);
		$criteria->compare('usr_password',$this->usr_password,true);
		$criteria->compare('usr_emal',$this->usr_emal,true);
		$criteria->compare('usr_direccion',$this->usr_direccion,true);
		$criteria->compare('usr_estado',$this->usr_estado);
		$criteria->compare('usr_fecadd',$this->usr_fecadd,true);
		$criteria->compare('usr_fecupd',$this->usr_fecupd,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

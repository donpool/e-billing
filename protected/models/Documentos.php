<?php

/**
 * This is the model class for table "documentos".
 *
 * The followings are the available columns in table 'documentos':
 * @property integer $doc_codigo
 * @property integer $usr_codigo
 * @property integer $doc_clave_acceso
 * @property integer $doc_cod_doc
 * @property string $doc_fecha_emision
 * @property double $doc_valor_total
 * @property string $doc_sujeto_retencion
 * @property integer $doc_estado
 * @property string $doc_fecadd
 * @property string $doc_fecupd
 * @property integer $usr_codigoupd
 */
class Documentos extends CActiveRecord
{
    
    private $clientId;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documentos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usr_codigo, doc_clave_acceso, doc_cod_doc, doc_fecha_emision', 'required'),
			array('usr_codigo, doc_clave_acceso, doc_cod_doc, doc_estado, usr_codigoupd', 'numerical', 'integerOnly'=>true),
			array('doc_valor_total', 'numerical'),
			array('doc_num_documento', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('doc_codigo, usr_codigo, doc_clave_acceso, doc_cod_doc, doc_fecha_emision, doc_valor_total,  doc_estado, doc_fecadd, doc_fecupd, usr_codigoupd, doc_numerodelibro, doc_estadopago, doc_formapago, doc_comisiona, doc_retencion', 'safe', 'on'=>'search'),
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
			'Usuarios' => array(self::BELONGS_TO, 'Usuarios', 'usr_codigo'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'doc_codigo' => 'Codigo',
			'usr_codigo' => 'Usuario',
			'doc_clave_acceso' => 'Clave de Acceso',
			'doc_cod_doc' => 'Tipo Documento',
			'doc_fecha_emision' => 'Fecha  Emision',
			'doc_valor_total' => 'Valor Total',
			'doc_sujeto_retencion' => 'Sujeto Retencion',
			'doc_estado' => 'Doc Estado',
			'doc_fecadd' => 'Doc Fecadd',
			'doc_fecupd' => 'Doc Fecupd',
			'usr_codigoupd' => 'Usr Codigoupd',
			'doc_num_documento' => 'Nº. Documento',
			'doc_matrizador' => 'Matrizador',
            'doc_numerodelibro' => '# Libro',
			'doc_subtotal' => 'Subtotal',
			'doc_iva' => 'IVA',
			'doc_total' => 'Total',
            'doc_estadopago' => 'E/P',
            'doc_formapago' => 'F/P',
            'doc_comisiona' => 'Com',
            'doc_retencion' => 'Ret',
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
	public function search($clientId=null,$limit=null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
  

		$criteria=new CDbCriteria;
                $criteria->alias = "t";
		$criteria->compare('doc_codigo',$this->doc_codigo);
                $usr_codigo = (!empty($clientId) )  ? $clientId : $this->clientId;
		$criteria->compare('t.usr_codigo',$usr_codigo);
                $criteria->compare('Usuarios.usr_nombre',$this->usr_codigo,true);
                $criteria->with='Usuarios';
               // $criteria->compare('Usuarios.usr_ruc',$this->usr_codigo,true);
                //$criteria->with='Usuarios';
		$criteria->compare('doc_clave_acceso',$this->doc_clave_acceso);
		$criteria->compare('doc_cod_doc',$this->doc_cod_doc);
                if ( !empty($_GET['doc_fecha_emisionFin']) && !empty($this->doc_fecha_emision)){
                    $fechaFin=$_GET['doc_fecha_emisionFin'];
                    $criteria->addCondition('doc_fecha_emision >= "'.$this->doc_fecha_emision.'" ');
                    $criteria->addCondition('doc_fecha_emision <= "'.$fechaFin.'" ');
                }
                   if ( !empty($_GET['usr_ruc'])){
                    $criteria->compare('Usuarios.usr_ruc',$_GET['usr_ruc'],true);
                    $criteria->with='Usuarios';
                   }
                   
                   if ( !empty($_GET['usr_email'])){
                    $criteria->compare('Usuarios.usr_emal',$_GET['usr_email'],true);
                    $criteria->with='Usuarios';
                   }
               
                    
		$criteria->compare('doc_fecha_emision',$this->doc_fecha_emision,true);
                
		$criteria->compare('doc_valor_total',$this->doc_valor_total);
		 $criteria->compare('doc_num_documento',$this->doc_num_documento,true);
		$criteria->compare('doc_estado',$this->doc_estado);
		$criteria->compare('doc_fecadd',$this->doc_fecadd,true);
		$criteria->compare('doc_fecupd',$this->doc_fecupd,true);
		$criteria->compare('usr_codigoupd',$this->usr_codigoupd);
                $criteria->order = 'doc_codigo DESC';
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        

        

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Documentos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
    /*
     * Lista Documentos por Usuario
     */
    public static function fnListDocuments($usr_codigo=null){

        $usuario="";
        if ($usr_codigo !=null) 
            $usuario=" and usr_codigo=".$usr_codigo;
        $sql="
        select * from documentos where doc_estado=true ".$usuario;

        $result=Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }
}

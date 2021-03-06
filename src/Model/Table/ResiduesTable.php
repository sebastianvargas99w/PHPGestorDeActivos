<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Residues Model
 *
 * @method \App\Model\Entity\Residue get($primaryKey, $options = [])
 * @method \App\Model\Entity\Residue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Residue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Residue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Residue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Residue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Residue findOrCreate($search, callable $callback = null, $options = [])
 */
class ResiduesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('residues');
        $this->setDisplayField('residues_id');
        $this->setPrimaryKey('residues_id');
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'file' => [
                'fields' => [
                    'dir' => 'file_dir',
                    'size' => 'file_size',
                    'type' => 'file_type',
                ],
                'path' => 'webroot{DS}files{DS}{model}{DS}{field}{DS}{field-value:residues_id}{DS}',
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return strtolower($data['name']);
                },

                'keepFilesOnDelete' => false
            ]
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('residues_id')
            ->maxLength('residues_id', 200)
            /*->add('residues_id', 'residues_id', [
            'rule' => [$this, 'isUnique'],
            'message' => __('El n??mero de autorizaci??n ya existe.')
            ])*/
            ->alphaNumeric('residues_id', 'El n??mero de autorizaci??n debe contener solo caracteres alfanum??ricos.')
            ->notEmpty('residues_id', 'El n??mero de autorizaci??n es requerido.');

        $validator
            ->scalar('name1')
            ->maxLength('name1', 50)
            ->requirePresence('name1', 'create')
            ->add('name1',[ 
                [
                'rule'=>['custom', ' /^[a-zA-Z??-????-????-?? ]+$/ '],
                'message'=>'Debe contener s??lo caracteres del alfabeto.'
                ]
            ])
            ->notEmpty('name1','Este campo es requerido.');

        $validator
            ->scalar('identification1')
            ->maxLength('identification1', 9,'La c??dula debe contener 9 d??gitos' )
            ->minLength('identification1', 9,'La c??dula debe contener 9 d??gitos' )
            ->numeric('identification1','La c??dula debe contener s??lo digitos')
            ->requirePresence('identification1', 'create')
            ->notEmpty('identification1','Este campo es requerido');

        $validator
            ->scalar('name2')
            ->maxLength('name2', 50)
            ->requirePresence('name2', 'create')            
            ->add('name2',[ 
                [
                'rule'=>['custom', ' /^[a-zA-Z??-????-????-?? ]+$/ '],
                'message'=>'Debe contener s??lo caracteres del alfabeto.'
                ]
            ])
            ->notEmpty('name2','Este campo es requerido');

        $validator
            ->scalar('identification2')
            ->requirePresence('identification2', 'create')
            ->numeric('identification2','La c??dula debe contener s??lo digitos')
            ->maxLength('identification2', 9,'La c??dula debe contener 9 d??gitos' )
            ->minLength('identification2', 9,'La c??dula debe contener 9 d??gitos' )
            ->notEmpty('identification2','Este campo es requerido');

        $validator
            ->date('date','ymd', 'Formato de fecha no v??lido.')
            ->notEmpty('date','Este campo es requerido');

        $validator
            ->boolean('descargado')
            ->allowEmpty('descargado');

        $validator
            ->maxLength('file', 255)
            ->allowEmpty('file');

        $validator
            ->scalar('file_dir')
            ->maxLength('file_dir', 255)
            ->allowEmpty('file_dir');

        return $validator;
    }

    /* Idea de las sigueintes 2 funciones  obtenida de https://stackoverflow.com/questions/14932739/cakephp-notempty-and-unique-validation-on-field , Zachary Heaton
    */
    public function uniqueId($id){
        $returnId = $this->find('all')
        ->where([
            'Residues.residues_id' => $id,
        ])
        ->first();
        if($returnId){
        return false;
        }
        return true;
    }
    
    public function buildRules(RulesChecker $rules)
    {
        
        $rules->addCreate(function ($entity, $options) {

        return $this->uniqueId($entity->residues_id);
        },
        'uniqueId',
        [
        'errorField' => 'residues_id',
        'message' => 'El n??mero de acta ya existe.'
        ]
        );

        return $rules;
    }
}

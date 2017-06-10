<?php

class AtribuicaoController {

        public function salvar(Request $request){
            $data = $request->all();

            DB::transaction(function(){

            }, 3);
        }

        public function update(Request $request){
            $data = $request->all();

            DB::transaction(function(){

            }, 3);
        }

        public function index(){
            return view('fpa.atribuicao_disciplinas');
        }
    
}
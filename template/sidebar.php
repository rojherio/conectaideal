<nav>
  <div class="app-logo">
    <a class="logo d-inline-block" href="index-2.html">
      <img alt="#" src="<?= IMG_FOLDER; ?>logo/delfos4.png">
    </a>
    <span class="bg-light-primary toggle-semi-nav">
      <i class="ti ti-chevrons-right f-s-20"></i>
    </span>
  </div>
  <div class="app-nav" id="app-simple-bar">
    <ul class="main-nav p-0 mt-2">
      <li class="menu-title"><span>Dados Base Gerais</span></li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_banco">
          <i class="iconoir-handbag"></i> Banco
        </a>
        <ul class="collapse" id="bsc_banco">
          <li><a href="<?=PORTAL_URL;?>view/bsc/banco_conta_tipo/cadastrar">Cadastrar Tipo de Banco</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/banco_conta_tipo/listar">Listar Tipos de Banco</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/banco/cadastrar">Cadastrar Banco</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/banco/listar">Listar Bancos</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_catadm">
          <i class="iconoir-handbag"></i> Categoria Administrativa
        </a>
        <ul class="collapse" id="bsc_catadm">
          <li><a href="<?=PORTAL_URL;?>view/bsc/categoria_administrativa/cadastrar">Cadastrar Categoria Adiminstrativa</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/categoria_administrativa/listar">Listar Categorias Adiminstrativa</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_escolaridade">
          <i class="iconoir-handbag"></i> Escolaridade
        </a>
        <ul class="collapse" id="bsc_escolaridade">
          <li><a href="<?=PORTAL_URL;?>view/bsc/escolaridade/cadastrar">Cadastrar Escolaridade</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/escolaridade/listar">Listar Escolaridades</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_esfadm">
          <i class="iconoir-handbag"></i> Esfera Administrativa
        </a>
        <ul class="collapse" id="bsc_esfadm">
          <li><a href="<?=PORTAL_URL;?>view/bsc/esfera_administrativa/cadastrar">Cadastrar Esfera Administrativa</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/esfera_administrativa/listar">Listar Esferas Administrativa</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_estciv">
          <i class="iconoir-handbag"></i> Estado Civil
        </a>
        <ul class="collapse" id="bsc_estciv">
          <li><a href="<?=PORTAL_URL;?>view/bsc/estado_civil/cadastrar">Cadastrar Estado Civil</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/estado_civil/listar">Listar Estados Civil</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_uni_med">
          <i class="iconoir-handbag"></i> Unidade de Medida
        </a>
        <ul class="collapse" id="bsc_uni_med">
          <li><a href="<?=PORTAL_URL;?>view/bsc/grandeza/cadastrar">Cadastrar Grandeza</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/grandeza/listar">Listar Grandezas</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/unidade_medida/cadastrar">Cadastrar Unidade de Medida</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/unidade_medida/listar">Listar Unidades de Mediada</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_pargrau">
          <i class="iconoir-handbag"></i> Grau de Parentesco
        </a>
        <ul class="collapse" id="bsc_pargrau">
          <li><a href="<?=PORTAL_URL;?>view/bsc/parentesco_grau/cadastrar">Cadastrar Grau de Parentesco</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/parentesco_grau/listar">Listar Graus de Parentescos</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_pesfis">
          <i class="iconoir-handbag"></i> Pessoa Física
        </a>
        <ul class="collapse" id="bsc_pesfis">
          <li><a href="<?=PORTAL_URL;?>view/bsc/pessoa_fisica/cadastrar">Cadastrar Pessoa Física</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/pessoa_fisica/listar">Listar Pessoas Física</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_pesjur">
          <i class="iconoir-handbag"></i> Pessoa Jurídica
        </a>
        <ul class="collapse" id="bsc_pesjur">
          <li><a href="<?=PORTAL_URL;?>view/bsc/pessoa_juridica/cadastrar">Cadastrar Pessoa Jurídica</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/pessoa_juridica/listar">Listar Pessoas Jurídica</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_setpub">
          <i class="iconoir-handbag"></i> Setor Público
        </a>
        <ul class="collapse" id="bsc_setpub">
          <li><a href="<?=PORTAL_URL;?>view/bsc/setor_publico/cadastrar">Cadastrar Setor Público</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/setor_publico/listar">Listar Setores Público</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_uniorg">
          <i class="iconoir-handbag"></i> Órgão Publico
        </a>
        <ul class="collapse" id="bsc_uniorg">
          <li><a href="<?=PORTAL_URL;?>view/bsc/uo_publico/cadastrar">Cadastrar Órgão Publico</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/uo_publico/listar">Listar Órgãos Publico</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#bsc_zona">
          <i class="iconoir-handbag"></i> Zona
        </a>
        <ul class="collapse" id="bsc_zona">
          <li><a href="<?=PORTAL_URL;?>view/bsc/zona/cadastrar">Cadastrar Zona</a></li>
          <li><a href="<?=PORTAL_URL;?>view/bsc/zona/listar">Listar Zona</a></li>
        </ul>
      </li>
      <li class="menu-title"> <span>UNIDADE EDUCATIVA</span> </li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#UEDadosBase">
          <i class="iconoir-home-alt"></i> Dados Base <span class="badge text-primary-dark bg-primary-300  badge-notification ms-2">4</span>
        </a>
        <ul class="collapse" id="UEDadosBase"><li class="another-level">
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_catescpriv">
              Categoria Escola Privada
            </a>
            <ul class="collapse" id="ue_catescpriv">
              <li><a href="<?=PORTAL_URL;?>view/ue/categoria_escola_privada/cadastrar">Cadastrar Categoria de Escola Privada</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/categoria_escola_privada/listar">Listar Categorias de Escola Privada</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_ensatetip">
              Tipo de Atendimento
            </a>
            <ul class="collapse" id="ue_ensatetip">
              <li><a href="<?=PORTAL_URL;?>view/ue/ensino_atendimento_tipo/cadastrar">Cadastrar Tipo de Atendimento</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/ensino_atendimento_tipo/listar">Listar Tipos de Atendimento</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_ensmodeta">
              Etapa de Ensino
            </a>
            <ul class="collapse" id="ue_ensmodeta">
              <li><a href="<?=PORTAL_URL;?>view/ue/ensino_atendimento_tipo/cadastrar">Cadastrar Modalidade de Ensino</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/ensino_atendimento_tipo/listar">Listar Modalidades de Ensino</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/ensino_atendimento_etapa/cadastrar">Cadastrar Etapa de Ensino</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/ensino_atendimento_etapa/listar">Listar Etapas de Ensino</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_ensprofor">
              Forma de Ensino Profissional
            </a>
            <ul class="collapse" id="ue_ensprofor">
              <li><a href="<?=PORTAL_URL;?>view/ue/ensino_profissional_tipo/cadastrar">Cadastrar Tipo de Ensino Profissional</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/ensino_profissional_tipo/listar">Listar Tipo de Ensino Profissional</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/ensino_profissional_forma/cadastrar">Cadastrar Forma de Ensino Profissional</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/ensino_profissional_forma/listar">Listar Formas de Ensino Profissional</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_equipamentos">
              Equipamentos
            </a>
            <ul class="collapse" id="ue_equipamentos">
              <li><a href="<?=PORTAL_URL;?>view/ue/equip_acesso_internet_aluno/cadastrar">Cadastrar Equipamento para Acessar a Internet</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/equip_acesso_internet_aluno/listar">Listar Equipamentos para Acessar a Internet</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/equip_rede_local_tipo/cadastrar">Cadastrar Tipo de Rede</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/equip_rede_local_tipo/listar">Listar Tipos de Rede</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/equipamento_computador_tipo/cadastrar">Cadastrar Tipo de Computador</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/equipamento_computador_tipo/listar">Listar Tipos de Computador</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/equipamento_ensino_aprendiz_tipo/cadastrar">Cadastrar Equipamento para Ensino</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/equipamento_ensino_aprendiz_tipo/listar">Listar Equipamentos para Ensino</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/equipamento_tecnologico_administrativo/cadastrar">Cadastrar Equipamento para Uso Técnico e Administrativo</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/equipamento_tecnologico_administrativo/listar">Listar Equipamentos para Uso Técnico e Administrativo</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_funcao">
              Função Desempenhada por Funcionarios
            </a>
            <ul class="collapse" id="ue_funcao">
              <li><a href="<?=PORTAL_URL;?>view/ue/funcao_tipo/cadastrar">Cadastrar Tipo de Função Desempenhada por Funcionarios</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/funcao_tipo/listar">Listar Tipo de Funções Desempenhada por Funcionarios</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/funcao/cadastrar">Cadastrar Função Desempenhada por Funcionarios</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/funcao/listar">Listar Funções Desempenhada por Funcionarios</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_funsit">
              Situação de Funcionamento
            </a>
            <ul class="collapse" id="ue_funsit">
              <li><a href="<?=PORTAL_URL;?>view/ue/funcionamento_situacao/cadastrar">Cadastrar Situações de Funcionamento</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/funcionamento_situacao/listar">Listar Situações de Funcionamento</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_infacerec">
              Recurso de Acessibilidade
            </a>
            <ul class="collapse" id="ue_infacerec">
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_acessib_recurso/cadastrar">Cadastrar Recurso de Acessibilidade</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_acessib_recurso/listar">Listar Recursos de Acessibilidade</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_infaguabatipo">
              Tipo de Abastecimento de Água
            </a>
            <ul class="collapse" id="ue_infaguabatipo">
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_acessib_recurso/cadastrar">Cadastrar Tipo de Abastecimento de Água</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_acessib_recurso/listar">Listar Tipos de Abastecimento de Água</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_infelefon">
              Fonte de Energia Elétrica
            </a>
            <ul class="collapse" id="ue_infelefon">
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_eletrica_fonte/cadastrar">Cadastrar Fonte de Energia Elétrica</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_eletrica_fonte/listar">Listar Fonte de Energia Elétrica</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_infesgtipo">
              Tipo de Esgotamento Sanitário
            </a>
            <ul class="collapse" id="ue_infesgtipo">
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_esgot_tipo/cadastrar">Cadastrar Tipo de Esgotamento Sanitário</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_esgot_tipo/listar">Listar Tipo de Esgotamento Sanitário</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_infespfis">
              Dependência/Espaço Físico
            </a>
            <ul class="collapse" id="ue_infespfis">
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_espaco_fisico/cadastrar">Cadastrar Dependência/Espaço Físico</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_espaco_fisico/listar">Listar Dependências/Espaços Físico</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_inflixdestipo">
              Tipo de Destinação do Lixo
            </a>
            <ul class="collapse" id="ue_inflixdestipo">
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_lixo_dest_tipo/cadastrar">Cadastrar Tipo de Destinação do Lixo</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_lixo_dest_tipo/listar">Listar Tipos de Destinação do Lixo</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_inflixdestipo">
              Tipo de tratamento do Lixo/Resíduos
            </a>
            <ul class="collapse" id="ue_inflixdestipo">
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_lixo_dest_tipo/cadastrar">Cadastrar Tipo de Destinação do Lixo</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_lixo_dest_tipo/listar">Listar Tipos de Destinação do Lixo</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_inflixorestratipo">
              Tipo de tratamento do Lixo/Resíduos
            </a>
            <ul class="collapse" id="ue_inflixorestratipo">
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_lixo_resid_trat_tipo/cadastrar">Cadastrar Tipo de tratamento do Lixo/Resíduos</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_lixo_resid_trat_tipo/listar">Listar Tipos de tratamento do Lixo/Resíduos</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_inflocfun">
              Local de Funcionamento da Escola
            </a>
            <ul class="collapse" id="ue_inflocfun">
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_lixo_resid_trat_tipo/cadastrar">Cadastrar Local de Funcionamento da Escola</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_lixo_resid_trat_tipo/listar">Listar Locais de Funcionamento da Escola</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_inflococufor">
              Forma de Ocupação do Prédio Escolar
            </a>
            <ul class="collapse" id="ue_inflococufor">
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_local_ocupacao/cadastrar">Cadastrar Forma de Ocupação do Prédio Escolar</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/infra_local_ocupacao/listar">Listar Formas de Ocupação do Prédio Escolar</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_intpubtipo">
              Público a Usufruir Da Internet da Unidade Escolar
            </a>
            <ul class="collapse" id="ue_intpubtipo">
              <li><a href="<?=PORTAL_URL;?>view/ue/internet_publico_tipo/cadastrar">Cadastrar Público a Usufruir Da Internet da Unidade Escolar</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/internet_publico_tipo/listar">Listar Públicos a Usufruir Da Internet da Unidade Escolar</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_locdif">
              Localização Diferenciada
            </a>
            <ul class="collapse" id="ue_locdif">
              <li><a href="<?=PORTAL_URL;?>view/ue/localizacao_diferenciada/cadastrar">Cadastrar Localização Diferenciada</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/localizacao_diferenciada/listar">Listar Localizações Diferenciada</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_parconfor">
              Forma de Contratação de Parceria ou Convênio
            </a>
            <ul class="collapse" id="ue_parconfor">
              <li><a href="<?=PORTAL_URL;?>view/ue/parceria_convenio_forma/cadastrar">Cadastrar Forma de Contratação de Parceria ou Convênio</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/parceria_convenio_forma/listar">Listar Formas de Contratação de Parceria ou Convênio</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_porte">
              Porte de Alunos
            </a>
            <ul class="collapse" id="ue_porte">
              <li><a href="<?=PORTAL_URL;?>view/ue/parceria_convenio_forma/cadastrar">Cadastrar Porte de Alunos</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/parceria_convenio_forma/listar">Listar Portes de Alunos</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_primantipo">
              Tipo de Mantenedora de Escola Privada
            </a>
            <ul class="collapse" id="ue_primantipo">
              <li><a href="<?=PORTAL_URL;?>view/ue/privada_mantenedora_tipo/cadastrar">Cadastrar Tipo de Mantenedora de Escola Privada</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/privada_mantenedora_tipo/listar">Listar Tipos de Mantenedora de Escola Privada</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_regsit">
              Situação de Regulamentação/Autorização da Escola
            </a>
            <ul class="collapse" id="ue_regsit">
              <li><a href="<?=PORTAL_URL;?>view/ue/regulam_situacao/cadastrar">Cadastrar Situação de Regulamentação/Autorização da Escola</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/regulam_situacao/listar">Listar Situações de Regulamentação/Autorização da Escola</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_turno">
              Horário de Turno
            </a>
            <ul class="collapse" id="ue_turno">
              <li><a href="<?=PORTAL_URL;?>view/ue/turno/cadastrar">Cadastrar Horário de Turno</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/turno/listar">Listar Horários de Turno</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_vintipo">
              Tipo de Vínculo a Outra Unidade Escolar
            </a>
            <ul class="collapse" id="ue_vintipo">
              <li><a href="<?=PORTAL_URL;?>view/ue/ue_vinculada_tipo/cadastrar">Cadastrar Tipo de Vínculo a Outra Unidade Escolar</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/ue_vinculada_tipo/listar">Listar Tipos de Vínculo a Outra Unidade Escolar</a></li>
            </ul>
          </li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ue_uo">
              Unidade Organizacional
            </a>
            <ul class="collapse" id="ue_uo">
              <li><a href="<?=PORTAL_URL;?>view/ue/uo_tipo/cadastrar">Cadastrar Tipo de Unidade Organizacional</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/uo_tipo/listar">Listar Tipos de Unidade Organizacional</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/uo/cadastrar">Cadastrar Unidade Organizacional</a></li>
              <li><a href="<?=PORTAL_URL;?>view/ue/uo/listar">Listar Unidade Organizacional</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#UEDiretoria">
          <i class="iconoir-home-alt"></i> Diretoria <span class="badge text-primary-dark bg-primary-300  badge-notification ms-2">4</span>
        </a>
        <ul class="collapse" id="UEDiretoria">
          <li><a href="index-2.html">Dashboard</a></li>
          <li><a href="index-2.html">Agenda</a></li>
          <li><a href="ecommerce_dashboard.html">Relatórios</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#UESecretaria">
          <i class="iconoir-home-alt"></i> Secretaria <span class="badge text-primary-dark bg-primary-300  badge-notification ms-2">4</span>
        </a>
        <ul class="collapse" id="UESecretaria">
          <li><a href="index-2.html">Dashboard</a></li>
          <li><a href="ecommerce_dashboard.html">INEP</a></li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#UESecretariaMural">
              Mural
            </a>
            <ul class="collapse" id="UESecretariaMural">
              <li><a href="line.html">Dashboard</a></li>
              <li><a href="line.html" title="Grupos de Destino">Grupos de Destino</a></li>
              <li><a href="line.html">Cadastro</a></li>
              <li><a href="line.html">Visualizações</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod2">
          <i class="iconoir-apple-shortcuts"></i> RH
        </a>
        <ul class="collapse" id="mod1submod2">
          <li><a href="calendar.html">Arquivo 1</a></li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod3arq1">Arquivo 2</a>
            <ul class="collapse" id="mod1submod3arq1">
              <li><a href="profile.html">Parametro 1</a></li>
              <li><a href="setting.html">Parametro 1</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod2">
          <i class="iconoir-apple-shortcuts"></i> Servidor
        </a>
        <ul class="collapse" id="mod1submod2">
          <li><a href="calendar.html">Arquivo 1</a></li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod3arq1">Arquivo 2</a>
            <ul class="collapse" id="mod1submod3arq1">
              <li><a href="profile.html">Parametro 1</a></li>
              <li><a href="setting.html">Parametro 1</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod2">
          <i class="iconoir-apple-shortcuts"></i> Professor
        </a>
        <ul class="collapse" id="mod1submod2">
          <li><a href="calendar.html">Arquivo 1</a></li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod3arq1">Arquivo 2</a>
            <ul class="collapse" id="mod1submod3arq1">
              <li><a href="profile.html">Parametro 1</a></li>
              <li><a href="setting.html">Parametro 1</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod2">
          <i class="iconoir-apple-shortcuts"></i> Turmas
        </a>
        <ul class="collapse" id="mod1submod2">
          <li><a href="calendar.html">Arquivo 1</a></li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod3arq1">Arquivo 2</a>
            <ul class="collapse" id="mod1submod3arq1">
              <li><a href="profile.html">Parametro 1</a></li>
              <li><a href="setting.html">Parametro 1</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod2">
          <i class="iconoir-apple-shortcuts"></i> Alunos
        </a>
        <ul class="collapse" id="mod1submod2">
          <li><a href="calendar.html">Arquivo 1</a></li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod3arq1">Arquivo 2</a>
            <ul class="collapse" id="mod1submod3arq1">
              <li><a href="profile.html">Parametro 1</a></li>
              <li><a href="setting.html">Parametro 1</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod2">
          <i class="iconoir-apple-shortcuts"></i> Coordenações
        </a>
        <ul class="collapse" id="mod1submod2">
          <li><a href="calendar.html">Arquivo 1</a></li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#mod1submod3arq1">Arquivo 2</a>
            <ul class="collapse" id="mod1submod3arq1">
              <li><a href="profile.html">Parametro 1</a></li>
              <li><a href="setting.html">Parametro 1</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="menu-title"><span>SEME</span></li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ui-kits">
          <i class="iconoir-handbag"></i> Unidades Educativas
        </a>
        <ul class="collapse" id="ui-kits">
          <li><a href="cheatsheet.html">Cheatsheet</a></li>
          <li><a href="alert.html">Alert</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#advance-ui">
          <i class="iconoir-shopping-bag-plus"></i> Servidores <span class="badge text-warning-dark bg-warning-400 badge-notification ms-2">
            12+
            <span class="visually-hidden">unread messages</span>
          </span>
        </a>
        <ul class="collapse" id="advance-ui">
          <li><a href="modals.html">Modals</a></li>
          <li><a href="offcanvas.html">Offcanvas Toggle</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#icons">
          <i class="iconoir-component"></i> Lotações
        </a>
        <ul class="collapse" id="icons">
          <li><a href="fontawesome.html">Fontawesome</a></li>
          <li><a href="flag_icons.html">Flag</a></li>
        </ul>
      </li>
      <li class="no-sub">
        <a class="" href="misc.html">
          <i class="iconoir-bookmark-book"></i> Capacitações
        </a>
      </li>
      <li class="no-sub">
        <a class="" href="misc.html">
          <i class="iconoir-bookmark-book"></i> Relatórios
        </a>
      </li>
      <li class="menu-title"><span>SEE</span></li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#maps">
          <i class="iconoir-map"></i> Unidade Educativas
        </a>
        <ul class="collapse" id="maps">
          <li><a href="google-map.html">Google Maps</a></li>
          <li><a href="vector-map.html">Vector map</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#chart">
          <i class="iconoir-lifebelt"></i> Relatórios
        </a>
        <ul class="collapse" id="chart">
          <li><a href="chartjs.html">Chart js</a></li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#apexcharts-page">
              Apexcharts
            </a>
            <ul class="collapse" id="apexcharts-page">
              <li><a href="line.html">Line</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="menu-title"><span>PREFEITURA</span></li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#table">
          <i class="iconoir-layout-right"></i> Índices
        </a>
        <ul class="collapse" id="table">
          <li><a href="basic_table.html">BasicTable</a></li>
          <li><a href="data_table.html">Data Table</a></li>
          <li><a href="list_table.html">List Js</a></li>
          <li><a href="advance_table.html">Advance Table</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#forms">
          <i class="iconoir-archive"></i> Unidades Educativas
        </a>
        <ul class="collapse" id="forms">
          <li><a href="form_validation.html">Form Validation</a></li>
          <li><a href="dual_listboxes.html">Dual Listbox</a></li>
          <li><a href="default_forms.html">Default Forms</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ready_to_use">
          <i class="iconoir-report-columns"></i> Relatórios  <span class="badge text-success-dark bg-success-400 badge-notification ms-2">New</span>
        </a>
        <ul class="collapse" id="ready_to_use">
          <li><a href="form_wizard_2.html">Form wizards 2</a></li>
          <li><a href="ready_to_use_form.html">Ready To Use Form</a></li>
          <li><a href="ready_to_use_table.html">Ready To Use Tables</a></li>
        </ul>
      </li>
      <li class="menu-title"><span>SERVIDOR</span></li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#auth_pages">
          <i class="ph-duotone  ph-notebook"></i> Sub Módulo 1
        </a>
        <ul class="collapse" id="auth_pages">
          <li><a href="two_step_verification_1.html">Two-Step Verification with Bg-image</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#error_pages">
          <i class="iconoir-warning-triangle"></i> Sub Módulo 2
        </a>
        <ul class="collapse" id="error_pages">
          <li><a href="error_400.html">Bad Request </a></li>
          <li><a href="error_503.html">Service Unavailable</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#other_pages">
          <i class="iconoir-multiple-pages"></i> Sub Módulo 3
        </a>
        <ul class="collapse" id="other_pages">
          <li><a href="blank.html">Blank</a></li>
          <li><a href="maintenance.html">Maintenance</a></li>
        </ul>
      </li>
      <li class="menu-title"><span>PROFESSOR</span></li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#level">
          <i class="iconoir-keyframes-couple"></i> Sub Módulo 1
        </a>
        <ul class="collapse" id="level">
          <li><a href="#">Blank</a></li>
          <li class="another-level">
            <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#level2">
              Another level
            </a>
            <ul class="collapse" id="level2">
              <li><a href="blank.html">Blank</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="no-sub">
        <a class="" href="https://phpstack-1384472-5121645.cloudwaysapps.com/document/php/axelit/index.html">
          <i class="iconoir-page-star"></i> Sub Módulo 2
        </a>
      </li>
      <li class="no-sub">
        <a class="" href="mailto:teqlathemes@gmail.com">
          <i class="iconoir-chat-bubble-question"></i> Sub Módulo 3
        </a>
      </li>
      <li class="menu-title"><span>PAIS</span></li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#table">
          <i class="iconoir-layout-right"></i> Sub Módulo 1
        </a>
        <ul class="collapse" id="table">
          <li><a href="basic_table.html">BasicTable</a></li>
          <li><a href="data_table.html">Data Table</a></li>
          <li><a href="list_table.html">List Js</a></li>
          <li><a href="advance_table.html">Advance Table</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#forms">
          <i class="iconoir-archive"></i> Sub Módulo 2
        </a>
        <ul class="collapse" id="forms">
          <li><a href="form_validation.html">Form Validation</a></li>
          <li><a href="dual_listboxes.html">Dual Listbox</a></li>
          <li><a href="default_forms.html">Default Forms</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ready_to_use">
          <i class="iconoir-report-columns"></i> Sub Módulo 3 <span class="badge text-success-dark bg-success-400 badge-notification ms-2">New</span>
        </a>
        <ul class="collapse" id="ready_to_use">
          <li><a href="form_wizard_2.html">Form wizards 2</a></li>
          <li><a href="ready_to_use_form.html">Ready To Use Form</a></li>
          <li><a href="ready_to_use_table.html">Ready To Use Tables</a></li>
        </ul>
      </li>
      <li class="menu-title"><span>ALUNO</span></li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#table">
          <i class="iconoir-layout-right"></i> Sub Módulo 1
        </a>
        <ul class="collapse" id="table">
          <li><a href="basic_table.html">BasicTable</a></li>
          <li><a href="data_table.html">Data Table</a></li>
          <li><a href="list_table.html">List Js</a></li>
          <li><a href="advance_table.html">Advance Table</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#forms">
          <i class="iconoir-archive"></i> Sub Módulo 2
        </a>
        <ul class="collapse" id="forms">
          <li><a href="form_validation.html">Form Validation</a></li>
          <li><a href="dual_listboxes.html">Dual Listbox</a></li>
          <li><a href="default_forms.html">Default Forms</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ready_to_use">
          <i class="iconoir-report-columns"></i> Sub Módulo 3 <span class="badge text-success-dark bg-success-400 badge-notification ms-2">New</span>
        </a>
        <ul class="collapse" id="ready_to_use">
          <li><a href="form_wizard_2.html">Form wizards 2</a></li>
          <li><a href="ready_to_use_form.html">Ready To Use Form</a></li>
          <li><a href="ready_to_use_table.html">Ready To Use Tables</a></li>
        </ul>
      </li>
      <li class="menu-title"><span>ALIMENTO ESCOLAR</span></li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#table">
          <i class="iconoir-layout-right"></i> Sub Módulo 1
        </a>
        <ul class="collapse" id="table">
          <li><a href="basic_table.html">BasicTable</a></li>
          <li><a href="data_table.html">Data Table</a></li>
          <li><a href="list_table.html">List Js</a></li>
          <li><a href="advance_table.html">Advance Table</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#forms">
          <i class="iconoir-archive"></i> Sub Módulo 2
        </a>
        <ul class="collapse" id="forms">
          <li><a href="form_validation.html">Form Validation</a></li>
          <li><a href="dual_listboxes.html">Dual Listbox</a></li>
          <li><a href="default_forms.html">Default Forms</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ready_to_use">
          <i class="iconoir-report-columns"></i> Sub Módulo 3 <span class="badge text-success-dark bg-success-400 badge-notification ms-2">New</span>
        </a>
        <ul class="collapse" id="ready_to_use">
          <li><a href="form_wizard_2.html">Form wizards 2</a></li>
          <li><a href="ready_to_use_form.html">Ready To Use Form</a></li>
          <li><a href="ready_to_use_table.html">Ready To Use Tables</a></li>
        </ul>
      </li>
      <li class="menu-title"><span>TRANSPORTE</span></li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#table">
          <i class="iconoir-layout-right"></i> Sub Módulo 1
        </a>
        <ul class="collapse" id="table">
          <li><a href="basic_table.html">BasicTable</a></li>
          <li><a href="data_table.html">Data Table</a></li>
          <li><a href="list_table.html">List Js</a></li>
          <li><a href="advance_table.html">Advance Table</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#forms">
          <i class="iconoir-archive"></i> Sub Módulo 2
        </a>
        <ul class="collapse" id="forms">
          <li><a href="form_validation.html">Form Validation</a></li>
          <li><a href="dual_listboxes.html">Dual Listbox</a></li>
          <li><a href="default_forms.html">Default Forms</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ready_to_use">
          <i class="iconoir-report-columns"></i> Sub Módulo 3 <span class="badge text-success-dark bg-success-400 badge-notification ms-2">New</span>
        </a>
        <ul class="collapse" id="ready_to_use">
          <li><a href="form_wizard_2.html">Form wizards 2</a></li>
          <li><a href="ready_to_use_form.html">Ready To Use Form</a></li>
          <li><a href="ready_to_use_table.html">Ready To Use Tables</a></li>
        </ul>
      </li>
      <li class="menu-title"><span>SEGURANÇA</span></li>
      <li class="no-sub">
        <a class="" href="widget.html">
          <i class="iconoir-view-grid"></i> Dashboard
        </a>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#table">
          <i class="iconoir-layout-right"></i> Sub Módulo 1
        </a>
        <ul class="collapse" id="table">
          <li><a href="basic_table.html">BasicTable</a></li>
          <li><a href="data_table.html">Data Table</a></li>
          <li><a href="list_table.html">List Js</a></li>
          <li><a href="advance_table.html">Advance Table</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#forms">
          <i class="iconoir-archive"></i> Sub Módulo 2
        </a>
        <ul class="collapse" id="forms">
          <li><a href="form_validation.html">Form Validation</a></li>
          <li><a href="dual_listboxes.html">Dual Listbox</a></li>
          <li><a href="default_forms.html">Default Forms</a></li>
        </ul>
      </li>
      <li>
        <a aria-expanded="false" class="" data-bs-toggle="collapse" href="#ready_to_use">
          <i class="iconoir-report-columns"></i> Sub Módulo 3 <span class="badge text-success-dark bg-success-400 badge-notification ms-2">New</span>
        </a>
        <ul class="collapse" id="ready_to_use">
          <li><a href="form_wizard_2.html">Form wizards 2</a></li>
          <li><a href="ready_to_use_form.html">Ready To Use Form</a></li>
          <li><a href="ready_to_use_table.html">Ready To Use Tables</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <div class="menu-navs">
    <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
    <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
  </div>
</nav>
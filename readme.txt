=== Buscapé Tracker ===
Contributors: danielcosta
Donate link: http://danielcosta.info/doacoes
Tags: tracking, buscape, bondfaro, statistics, monetiza&ccedil;&atilde;o, afiliados, Brasil
Requires at least: 2.1
Tested up to: 2.3.1
Stable tag: 0.9

Buscapé Tracker gera os links personalizados do programa de afiliados Buscapé/Bondfaro adaptados para o [ClickTracker](http://tracker.danielcosta.info/ "Conheça o ClickTracker").

Opções para turbinar seu programa de afiliados Buscapé. Baseado no BuscapéEW do Manoel Netto que foi 
modificado pelo Douglas Correa e aperfeiçoado para o ClickTracker.

== Description ==

O plugin Buscapé Tracker gera os links personalizados do programa de afiliados Buscapé/Bondfaro, especialmente adaptados para o [ClickTracker](http://tracker.danielcosta.info/ "Conheça o ClickTracker").

O [ClickTracker](http://tracker.danielcosta.info/ "Conheça o ClickTracker") é um serviço brasileiro de monitoramento de cliques dos programas de afiliados, que está sendo cada vez mais usado por blogueiros e webmasters interessados em conhecer mais o comportamento dos visitantes, com o objetivo de otimizar o trabalho de monetização.

Com este plugin será possível adicionar palavras-chaves automaticamente linkadas para o Buscapé e/ou Bondfaro.

= Nota =

Este é o primeiro plugin do programa de afiliados Buscapé/Bondfaro oficialmente hospedado no repositório de plugins do Wordpress.


== Installation ==

A instala&ccedil;&atilde;o do plugin &eacute; bastante simples.

1. Fa&ccedil;a upload do arquivo **buscape-tracker.php** para a pasta **/wp-content/plugins/**
2. **Ative** o Buscapé Tracker no menu **Plugins** do Wordpress
3. Vá em **Op&ccedil;&otilde;es**, **Buscapé Tracker**, digite seu **C&oacute;digo de Afiliado** e personalize a exibi&ccedil;&atilde;o dos links personalizados

**Instruções**

= Links =

Para utilizar o plugin com palavras dentro do seu texto, basta utilizar qualquer uma das possibilidades de código abaixo:

* **[BP]palavra[/BP]**
* **[BP:9999]palavra[/BP]** ou **[BP:categoria]palavra[/BP]**
* **[BP:9999:pesquisa]palavra[/BP]** ou **[BP:categoria:pesquisa]palavra[/BP]**

= Lista =

Para gerar uma lista personalizada de links exibidos no final do seu texto, basta utilizar qualquer uma das possibilidades de código abaixo:

* **[BL]palavra 1, palavra 2[/BL]**
* **[BL]palavra 1:9999, palavra 2:8888[/BL]**
* **[BL]palavra 1:categoria 1, palavra 2:categoria 2[/BL]**
* **[BL]palavra 1:9999:pesquisa 1, palavra 2:8888:pesquisa 2[/BL]**
* **[BL]palavra 1:categoria 1:pesquisa 1, palavra 2:categoria 2:pesquisa 2[/BL]**

Obs.: É aconselhável inserir esse código dentro de um bloco de comentários HTML: **&lt;-- código -- &gt;**, pois caso você desative o plugin, seu texto não ficará poluído.

= LEGENDAS =

* **9999** - é o código da categoria no Buscapé (pode ser utilizado um atalho de categoria)
* **palavra** - é a palavra que vai ser exibida no seu post
* **pesquisa** - é a palavra que vai ser pesquisada no Buscapé, dentro da categoria indicada
* **categoria** - segunda opção de categoria, só que usando um nome ao invés do código (confira abaixo a lista dos atalhos de categorias)


== Frequently Asked Questions ==

 = Já tenho o plugin oferecido pelo Tecnocracia/BrPoint/Contraditorium instalado no meu blog. O que devo fazer? = 

 Este plugin utiliza as mesmas tags que são interpretadas pelos demais plugins, então é preciso desativar esses outros antes de começar a usar o Buscapé Tracker.
 
 = Terei problema caso queira testar o Buscapé Tracker e depois resolva voltar para um dos plugins citados anteriormente? = 
 
 Não! Exceto se você utilizar as tags personalizadas exclusivas do Buscapé Tracker, que não são interpretadas pelos demais plugins.
 
 = Posso determinar uma categoria específica para a palavra-chave monetizada? = 
 
 A nossa sugestão é que você deve fazer isso sempre! Com a categorização das palavras, o visitante fica muito mais próximo do clique loja, aumentando muito as suas chances de fazer dinheiro com aquele clique.
 
 = O ClickTracker exibe os relatórios em tempo real? =
 
 Sim! Todos os relatórios exibem os resultados gerados até o momento da consulta.
 
 = Qual a vantagem de usar o ClickTracker? =
 
 O [ClickTracker](http://tracker.danielcosta.info/ "Conheça o ClickTracker") exibe relatórios das palavras mais clicadas, das páginas que mais geram cliques, detalha esses dados por período, e ainda fornece um ranking exclusivo das palavras que mais atraem clicadores. Além de ser um serviço gratuito e com garantia atestada por inúmeros sites e blogs com bastante visitação.


== Hist&oacute;rico ==

Vers&atilde;o 09 (beta) - 2007-10-21:

* Primeira vers&atilde;o pública com funcionalidades b&aacute;sicas baseadas nos plugins do Bruno Alves, Carlos Cardoso, Manoel Netto e Douglas "Cardosinho" Correa.
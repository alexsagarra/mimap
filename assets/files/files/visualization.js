import {
    Scene,
    PerspectiveCamera,
    WebGLRenderer,
    BoxGeometry,
    MeshBasicMaterial,
    Mesh,
    Vector3,
    AxesHelper,
    AmbientLight,
    DirectionalLight,
    Box3
} from "./three.js-master/build/three.module.js";
import {
    OBJLoader2
} from './three.js-master/examples/jsm/loaders/OBJLoader2.js';
import {
    MTLLoader
} from "./three.js-master/examples/jsm/loaders/MTLLoader.js";
import {
    OrbitControls
} from "./three.js-master/examples/jsm/controls/OrbitControls.js";


import {
    MtlObjBridge
} from './three.js-master/examples/jsm/loaders/obj2/bridge/MtlObjBridge.js';



const E_Z = new Vector3(0, 0, 1);


/**
 * Create orbit controls.
 */
function init_controls(camera, renderer) {
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableZoom = true;
    controls.autoRotate = true;
    controls.autoRotateSpeed = 1.;
    return controls;
}


/**
 * Add lightning to scene.
 */
function setup_lightning(scene) {
    var ambient = new AmbientLight(0x444444);
    scene.add(ambient);

    var directionalLight = new DirectionalLight(0xffeedd);
    //directionalLight.position.set( 0, 0, 1 ).normalize();
    directionalLight.position.set(0, 1, 0).normalize();
    scene.add(directionalLight);
}


/**
 * Load Migros moon store model into scene.
 */
function load_model(scene) {
    var mtlLoader = new MTLLoader();
    //mtlLoader.setBaseUrl( 'obj/fil' );
    //mtlLoader.setPath( 'obj/fil' );
    mtlLoader.load(
        'Filiale.mtl',
        //'VT1-2_FFK_B_Rendering_ohne_Ware.mtl',
        function(matResults) {
            console.log('MTL loaded');
            matResults.preload();
            var objLoader = new OBJLoader2();
            const materials = MtlObjBridge.addMaterialsFromMtlLoader(matResults);
            //materials.Material.side = DoubleSide;
            objLoader.addMaterials(materials);
            objLoader.load('Filiale.obj',
                /**
                 * On load callback.
                 */
                function(object) {
                    scene.add(object);
                },

                /**
                 * On progresses callback.
                 */
                function(xhr) {
                    console.log((xhr.loaded / xhr.total * 100) + '% loaded');
                },

                /*
                 * On error
                 */
                function(error) {
                    console.log('An error happened');
                }
            );
        }
    );
}


/**
 * Load three model and visualize Migros moon store.
 */
export function visualize_store(canvas) {
    var scene = new Scene();

    {
        const fov = 75;
        const aspect = window.innerWidth / window.innerHeight;
        const near = 0.1;
        const far = 10000;
        var camera = new PerspectiveCamera(fov, aspect, near, far);
    }

    var renderer = new WebGLRenderer({
        canvas: canvas,
        antialias: true,
    });
    renderer.setSize(window.innerWidth, window.innerHeight);


    // Position camera
    camera.position.set(
        //1200, 1000, 2000
        2382 / 2 + 200, 1000, 1500,
    );

    var center = new Vector3(
        //1178.6991405, 165., -1878.2367355
        2382 / 2, 530/2, -3805 / 2,
    );
    camera.lookAt(center);

    const controls = init_controls(camera, renderer);

    controls.target.copy(center);

    load_model(scene);
    setup_lightning(scene);

    var axesHelper = new AxesHelper( 1000 );
    scene.add( axesHelper );
    


    renderer.render(scene, camera);

    var animate = function() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
        controls.update();
    }

    animate();
}
